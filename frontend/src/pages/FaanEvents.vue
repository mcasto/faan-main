<template>
  <div class="faan-events">
    <router-view :header="header" :list="list"></router-view>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { computed } from "vue";

const store = useStore();

const type = store.router.currentRoute.value.name;

const header = computed(() => {
  if (type === "upcoming-events") return store.events.upcoming.header;
  if (type === "past-events") return store.events.past.header;
  return "";
});

const list = computed(() => {
  const list =
    type === "upcoming-events" ? store.events.upcoming : store.events.past;

  const output = { ...list };
  delete output.header;

  return Object.values(output);
});
</script>
