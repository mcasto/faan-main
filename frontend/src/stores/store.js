import { defineStore } from "pinia";
import { ref } from "vue";
import submitForm from "./actions/submit-form";

export const useStore = defineStore(
  "store",
  () => {
    const state = {
      adoptions: ref(null),
      drawer: ref(false),
      events: ref({
        past: [],
        upcoming: [],
      }),
      home: ref(null),
      language: ref("en"),
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
