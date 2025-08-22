<template>
  <div class="row">
    <!-- volunteer -->
    <div class="col-12 col-md-5 q-pa-sm">
      <div class="text-h6">
        {{ store.volunteering.volunteer.header }}
      </div>
      <template
        v-for="(paragraph, index) in store.volunteering.volunteer.paragraphs"
        :key="index"
      >
        <div class="q-mt-md">{{ paragraph }}</div>
      </template>
    </div>

    <!-- separator for small screens -->
    <div v-if="Screen.lt.md" class="col-12">
      <q-separator spaced></q-separator>
    </div>

    <!-- paws for coffee -->
    <div class="col-12 col-md-3 q-pa-sm">
      <q-img :src="store.volunteering.pawsForCoffee.image"></q-img>
    </div>

    <div class="col-12 col-md-4 q-pa-sm">
      <div class="text-h6">
        {{ store.volunteering.pawsForCoffee.header }}
      </div>
      <template
        v-for="(paragraph, index) in store.volunteering.pawsForCoffee
          .paragraphs"
        :key="index"
      >
        <div class="q-mt-md">{{ paragraph }}</div>
      </template>
    </div>

    <!-- separator for small screens -->
    <div v-if="Screen.lt.md" class="col-12">
      <q-separator spaced></q-separator>
    </div>

    <!-- pawffice -->
    <div class="col-12 col-md-5 q-pa-sm">
      <div class="text-h6 q-mb-sm">
        {{ store.volunteering.pawffice.header }}
      </div>
      <div class="text-subtitle2 q-mb-sm">
        <div v-html="store.volunteering.pawffice.action"></div>
      </div>

      <div class="text-subtitle1">
        {{ store.volunteering.pawffice.subtitle }}
      </div>

      <q-list>
        <q-item
          v-for="item of store.volunteering.pawffice.skills"
          :key="item"
          dense
        >
          <q-item-section side class="text-black">
            <q-icon name="circle" size=".5rem"></q-icon>
          </q-item-section>
          <q-item-section>
            <q-item-label>{{ item }}</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>

    <!-- separator for small screens -->
    <div v-if="Screen.lt.md" class="col-12">
      <q-separator spaced></q-separator>
    </div>

    <!-- welfare -->
    <div class="col-12 col-md-3 q-pa-sm">
      <q-img :src="store.volunteering.welfare.image">
        <div class="absolute-bottom">
          {{ store.volunteering.welfare.caption }}
        </div>
      </q-img>
    </div>

    <div class="col-12 col-md-4 q-pa-sm">
      <div class="text-h6">
        {{ store.volunteering.welfare.header }}
      </div>
      <template
        v-for="(paragraph, index) in store.volunteering.welfare.paragraphs"
        :key="index"
      >
        <div class="q-mt-md">{{ paragraph }}</div>
      </template>
    </div>

    <!-- separator -->
    <div class="col-12">
      <q-separator spaced></q-separator>
    </div>

    <!-- faan-atics -->
    <div class="col-12">
      <div class="text-subtitle2 q-pa-sm">
        {{ store.volunteering.faanAtics.header }}
      </div>
      <div class="row">
        <div
          class="col-12 col-md-3 q-pa-sm"
          v-for="(image, idx) of store.volunteering.faanAtics.images"
          :key="idx"
        >
          <q-img :src="image" class="full-height" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";

const store = useStore();
</script>
