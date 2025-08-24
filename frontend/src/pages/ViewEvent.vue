<template>
  <q-toolbar class="shadow-1 q-py-sm q-mb-md bg-blue-1">
    <q-toolbar-title>
      {{ store.event.title }}
      <div class="text-subtitle1">{{ store.event.subtitle }}</div>
      <div v-if="!store.event.hide_dates" class="text-caption">
        {{ format(store.event.starts, "PP") }} -
        {{ format(store.event.expires, "PP") }}
      </div>
    </q-toolbar-title>
  </q-toolbar>

  <div class="q-pa-md faan-event">
    <div v-html="store.event.html"></div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { format } from "date-fns";

const store = useStore();
</script>
