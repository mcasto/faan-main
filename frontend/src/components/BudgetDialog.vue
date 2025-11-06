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
        <div class="text-h6">Theme</div>
        <div>
          <div v-html="theme"></div>
        </div>
      </q-card-section>
      <q-card-section>
        <div class="text-h6">Description</div>
        <div>
          <div v-html="description"></div>
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script setup>
const model = defineModel();
const props = defineProps(["title", "theme", "description"]);
</script>
