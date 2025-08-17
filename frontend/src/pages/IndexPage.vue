<template>
  <div class="flex flex-center" style="height: 100vh;">
    <q-img src="images/home-splash.jpg" height="100vh" width="100vw">
      <div class="absolute-bottom" v-html="store.home.footer"></div>
    </q-img>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
