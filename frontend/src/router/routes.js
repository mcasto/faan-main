const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        meta: { label: "Home" },
        name: "home",
      },
      {
        path: "shelter-project",
        component: () => import("pages/ShelterProjectPage.vue"),
        meta: { label: "Shelter Project" },
        name: "shelter-project",
      },
      {
        path: "faan-events",
        component: () => import("pages/FaanEvents.vue"),
        children: [
          {
            path: "/upcoming-events",
            component: () => import("pages/UpcomingEvents.vue"),
            meta: { label: "Upcoming Events", isChild: true },
            name: "upcoming-events",
          },
          {
            path: "/past-events",
            component: () => import("pages/PastEvents.vue"),
            meta: { label: "Past Events", isChild: true },
            name: "past-events",
          },
        ],
        meta: { label: "FAAN Events" },
        name: "faan-events",
      },
      {
        path: "adoptions",
        component: () => import("pages/AdoptionsPage.vue"),
        meta: { label: "Adoptions" },
        name: "adoptions",
      },
      {
        path: "donate",
        component: () => import("pages/DonatePage.vue"),
        children: [
          {
            path: "/donations",
            component: () => import("pages/DonationsPage.vue"),
            meta: { label: "Donations", isChild: true },
            name: "donations",
          },
          {
            path: "/legacy-giving",
            component: () => import("pages/LegacyGiving.vue"),
            meta: { label: "Legacy Giving", isChild: true },
            name: "legacy-giving",
          },
        ],
        meta: { label: "Donate" },
        name: "donate",
      },
      {
        path: "volunteering",
        component: () => import("pages/VolunteeringPage.vue"),
        meta: { label: "Volunteering" },
        name: "volunteering",
      },
      {
        path: "meet-the-faantastics",
        component: () => import("pages/MeetTheFaantastics.vue"),
        meta: { label: "Meet the FAAN-TASTICS" },
        name: "meet-the-faantastics",
      },
      {
        path: "media-resources",
        component: () => import("pages/MediaResources.vue"),
        meta: { label: "Media/Resources" },
        name: "media-resources",
      },
      {
        path: "gala-faantastica",
        meta: {
          label: "GALA-FAANTASTICA",
          external: "https://gala.faanecuador.org",
        },
        name: "gala-faantastica",
      },
      {
        path: "contact-us",
        component: () => import("pages/ContactUs.vue"),
        meta: { label: "Contact Us" },
        name: "contact-us",
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
