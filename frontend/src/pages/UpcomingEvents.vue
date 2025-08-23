<template>
  <div class="q-pa-md">
    <div class="text-center text-h6">
      {{ header }}
    </div>
    <q-separator spaced></q-separator>
    <q-list separator>
      <q-item
        v-for="event in list"
        :key="event.id"
        :to="`/event/${event.slug}`"
      >
        <q-item-section>
          <q-item-label>{{ event.title }}</q-item-label>
          <q-item-label subtitle>{{ event.subtitle }}</q-item-label>
          <q-item-label caption v-if="!event.hide_dates">
            {{ format(event.starts, "PP") }} - {{ format(event.expires, "PP") }}
          </q-item-label>
        </q-item-section>
        <q-item-section side>
          <q-icon name="mdi-link-variant"></q-icon>
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script setup>
import { format } from "date-fns";
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
