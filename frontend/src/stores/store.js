import { defineStore } from "pinia";
import { ref } from "vue";
import submitForm from "./actions/submit-form";

export const useStore = defineStore(
  "store",
  () => {
    const state = {
      adoptions: ref(null),
      contact: ref(null),
      drawer: ref(false),
      donations: ref(null),
      event: ref(null),
      events: ref({
        past: [],
        upcoming: [],
      }),
      home: ref(null),
      language: ref("en"),
      legacyGiving: ref(null),
      mediaResources: ref(null),
      meetFaantastics: ref(null),
      meta: ref(null),
      sanctuary: ref(null),
      token: ref(null),
      user: ref(null),
    };
    const getters = {};
    const actions = {
      submitForm,
    };

    return { ...state, ...getters, ...actions };
  },
  {
    persist: {
      key: "faan-main",
    },
  }
);
