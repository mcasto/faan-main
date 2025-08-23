<template>
  <div class="q-pa-md">
    <div v-html="store.event.html"></div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
