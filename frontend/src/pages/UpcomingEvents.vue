<template>
  <div>
    <!-- -->
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();

console.log(store.events.upcoming);
</script>
