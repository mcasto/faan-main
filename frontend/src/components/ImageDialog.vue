<template>
  <q-dialog v-model="model" full-height full-width>
    <q-card dark>
      <q-btn
        round
        color="grey-8"
        icon="close"
        class="fixed-top-right q-mt-md q-mr-md"
        style="z-index: 999;"
        @click="model = false"
      ></q-btn>
      <q-card-section>
        <q-img :src="props.image" />
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script setup>
const model = defineModel();
const props = defineProps(["image"]);
</script>
