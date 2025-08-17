import { defineStore } from "pinia";
import { ref, computed } from "vue";

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
    const actions = {};

    return { ...state, ...getters, ...actions };
  },
  {
    persist: {
      key: "faan-main",
    },
  }
);
