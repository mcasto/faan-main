<template>
  <div class="q-pa-md">
    <div class="row">
      <div class="col-12 col-md-6 q-pa-sm">
        <div class="text-h6">
          {{ store.donations.header }}
        </div>
        <div class="text-subtitle1">
          {{ store.donations.subtitle }}
        </div>
        <q-separator spaced></q-separator>
        <div class="text-subtitle2">
          {{ store.donations.contributionHeader }}
        </div>
        <div v-html="store.donations.contributionInfo" class="q-ml-md"></div>
        <q-separator spaced></q-separator>
        <div class="text-subtitle2">
          {{ store.donations.joinHeader }}
        </div>
        <div v-html="store.donations.joinBullets"></div>
        <div v-html="store.donations.matchingGrant"></div>
        <div>
          <donation-form></donation-form>
        </div>
      </div>
      <div class="col-12 col-md-6 q-pa-sm">
        <q-img :src="store.donations.redCarpet.image">
          <div class="absolute-top">
            {{ store.donations.redCarpet.caption }}
          </div>
        </q-img>

        <div class="row q-mt-md">
          <div
            class="col-6"
            v-for="(image, idx) of store.donations.pawImages"
            :key="`paw-image-${idx}`"
          >
            <q-img :src="image" class="q-mb-md"> </q-img>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import DonationForm from "src/components/DonationForm.vue";

const store = useStore();
</script>
