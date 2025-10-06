<template>
  <div class="flex flex-center" style="height: 100vh;">
    <q-toolbar>
      <q-toolbar-title class="text-h4">
        {{ release.title }}
      </q-toolbar-title>
    </q-toolbar>

    <div v-html="release.body" class="q-px-xl"></div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();

const release = store.mediaResources.mediaRelease;

console.log({ release });
</script>
