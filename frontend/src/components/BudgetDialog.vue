<template>
  <q-dialog v-model="model">
    <q-card>
      <q-toolbar>
        <q-toolbar-title class="text-h5">
          {{ title }}
        </q-toolbar-title>
        <q-btn icon="close" round flat @click="model = false" size="sm"></q-btn>
      </q-toolbar>
      <q-separator></q-separator>
      <q-card-section>
        <div class="text-h6">{{ themeHeader }}</div>
        <div>
          <div v-html="theme"></div>
        </div>
      </q-card-section>
      <q-card-section>
        <div class="text-h6">{{ descriptionHeader }}</div>
        <div>
          <div v-html="description"></div>
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { computed } from "vue";

const store = useStore();

const model = defineModel();
const props = defineProps(["title", "theme", "description"]);

const themeHeader = computed(() => {
  return store.lang == "en" ? "Theme" : "Tema";
});

const descriptionHeader = computed(() => {
  return store.lang == "en" ? "Description" : "Descripción";
});
</script>
