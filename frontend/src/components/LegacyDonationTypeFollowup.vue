<template>
  <div class="col-12 col-md-6 q-pa-xs">
    <q-input
      :type="followup.type"
      :label="followup.label"
      dense
      outlined
      v-model="model"
      v-if="donation_type"
      required
    ></q-input>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { computed } from "vue";

const store = useStore();
const model = defineModel();
const props = defineProps(["donation_type"]);

const followup = computed(() => {
  return (
    store.legacyGiving.formConfig.donation_type.followups[
      props.donation_type.value
    ] || null
  );
});
</script>
