import { before } from "lodash-es";
import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";

const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    beforeEnter: async () => {
      const store = useStore();

      store.events.upcoming = await callApi({
        path: "/events/upcoming",
        method: "get",
      });

      store.events.past = await callApi({
        path: "/events/past",
        method: "get",
      });
    },
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.home = await callApi({ path: "/home", method: "get" });
        },
        meta: { label: { en: "Home", es: "Inicio" } },
        name: "home",
      },
      {
        path: "shelter-project",
        component: () => import("pages/ShelterProjectPage.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.shelter = await callApi({
            path: "/shelter-project",
            method: "get",
          });
        },
        meta: { label: { en: "Shelter Project", es: "Proyecto de Refugio" } },
        name: "shelter-project",
      },
      {
        path: "faan-events",
        component: () => import("pages/FaanEvents.vue"),
        children: [
          {
            path: "/upcoming-events",
            component: () => import("pages/UpcomingEvents.vue"),
            meta: {
              label: { en: "Current / Upcoming", es: "Actual / Próximo" },
              isChild: true,
            },
            name: "upcoming-events",
          },
          {
            path: "/past-events",
            component: () => import("pages/PastEvents.vue"),
            meta: { label: { en: "Past", es: "Pasado" }, isChild: true },
            name: "past-events",
          },
        ],
        meta: { label: { en: "FAAN Events", es: "Eventos FAAN" } },
        name: "faan-events",
      },
      {
        path: "adoptions",
        component: () => import("pages/AdoptionsPage.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.adoptions = await callApi({
            path: "/adoptions",
            method: "get",
          });
        },
        meta: { label: { en: "Adoptions", es: "Adopciones" } },
        name: "adoptions",
      },
      {
        path: "donate",
        component: () => import("pages/DonatePage.vue"),
        children: [
          {
            path: "/donations",
            component: () => import("pages/DonationsPage.vue"),
            beforeEnter: async () => {
              const store = useStore();
              store.donations = await callApi({
                path: "/donations",
                method: "get",
              });
            },
            meta: {
              label: { en: "Donations", es: "Donaciones" },
              isChild: true,
            },
            name: "donations",
          },
          {
            path: "/legacy-giving",
            component: () => import("pages/LegacyGiving.vue"),
            beforeEnter: async () => {
              const store = useStore();
              store.legacyGiving = await callApi({
                path: "/legacy-giving",
                method: "get",
              });
            },
            meta: {
              label: { en: "Legacy Giving", es: "Donación Legado" },
              isChild: true,
            },
            name: "legacy-giving",
          },
        ],
        meta: { label: { en: "Donate", es: "Donar" } },
        name: "donate",
      },
      {
        path: "volunteering",
        component: () => import("pages/VolunteeringPage.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.volunteering = await callApi({
            path: "/volunteering",
            method: "get",
          });

          console.log({ volunteering: store.volunteering });
        },
        meta: { label: { en: "Volunteering", es: "Voluntariado" } },
        name: "volunteering",
      },
      {
        path: "meet-the-faantastics",
        component: () => import("pages/MeetTheFaantastics.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.meetFaantastics = await callApi({
            path: "/meet-the-faan-tastics",
            method: "get",
          });
        },
        meta: {
          label: {
            en: "Meet the FAAN-TASTICS",
            es: "Conoce a los FAAN-TASTICS",
          },
        },
        name: "meet-the-faantastics",
      },
      {
        path: "media-resources",
        component: () => import("pages/MediaResources.vue"),
        beforeEnter: async () => {
          const store = useStore();
          store.mediaResources = await callApi({
            path: "/media-resources",
            method: "get",
          });
        },
        meta: { label: { en: "Media/Resources", es: "Medios/Recursos" } },
        name: "media-resources",
      },
      {
        path: "gala-faantastica",
        meta: {
          label: { en: "GALA-FAANTASTICA", es: "GALA-FAANTASTICA" },
          external: "https://gala.faanecuador.org",
        },
        name: "gala-faantastica",
      },
      {
        path: "contact-us",
        component: () => import("pages/ContactUs.vue"),
        meta: { label: { en: "Contact Us", es: "Contáctenos" } },
        name: "contact-us",
      },
      {
        path: "event/:slug",
        component: () => import("pages/ViewEvent.vue"),
        beforeEnter: async (to) => {
          const store = useStore();

          store.event = await callApi({
            path: `/event/${to.params.slug}`,
            method: "get",
          });
        },
        meta: { label: { en: "View Event", es: "Ver Evento" }, visible: false },
        name: "view-event",
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
