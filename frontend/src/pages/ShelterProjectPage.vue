<template>
  <div class="row">
    <div class="col-12 col-md-8 info q-pa-md text-subtitle1">
      <div class="text-h4">
        {{ store.sanctuary.header }}
      </div>
      <div class="text-h6 q-mb-lg">
        {{ store.sanctuary.subtitle }}
      </div>

      <div v-html="store.sanctuary.overview"></div>

      <video :width="vid.width" :height="vid.height" controls>
        <source :src="store.sanctuary.video" type="video/mp4" />
        Your browser does not support the video tag.
      </video>

      <div v-html="store.sanctuary.community"></div>
    </div>
    <div class="location col-12 col-md-4 q-pa-md">
      <q-img :src="superdogsSrc" class="q-mb-md" alt="SuperDogs Logo" />
    </div>
  </div>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";
import { computed, ref } from "vue";

const store = useStore();

const vid = computed(() => {
  const originalWidth = 854;
  const originalHeight = 480;

  let width = Screen.gt.sm ? Screen.width * 0.5 : Screen.width * 0.9;
  if (width > 854) {
    width = 854;
  }

  const height = Math.round((originalHeight / originalWidth) * width);

  return {
    width,
    height,
  };
});

const superdogsSrc = computed(() => {
  return `/images/superdogs-logo-${store.language}.png`;
});
</script>

<style scoped>
/* Optional styling for better visual hierarchy */
.q-item {
  border-left: 3px solid transparent;
}
.q-item:hover {
  border-left: 3px solid #1976d2;
  background-color: rgba(25, 118, 210, 0.04);
}
</style>
