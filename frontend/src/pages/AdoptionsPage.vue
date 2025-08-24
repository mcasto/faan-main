<template>
  <div class="row">
    <div class="col-12 col-md-6 q-pa-md">
      <div class="text-h6">
        {{ store.adoptions.bannerLeftHeader }}
      </div>
      <div class="q-mt-md">
        {{ store.adoptions.bannerLeftText }}
      </div>
    </div>
    <div class="col-12 col-md-6 q-pa-md">
      <div class="text-h6">
        {{ store.adoptions.bannerRightHeader }}
      </div>
      <div class="q-mt-md" v-html="store.adoptions.bannerRightText"></div>
    </div>

    <div class="col-12 text-h6 text-center">
      {{ store.adoptions.bannerBottom }}
    </div>

    <div
      class="col-12 q-pa-md q-mt-md"
      v-html="store.adoptions.adopteeHeader"
    ></div>

    <div class="col-12">
      <q-carousel
        v-model="slide"
        transition-prev="scale"
        transition-next="scale"
        swipeable
        animated
        control-color="black"
        padding
        arrows
        class="shadow-1 rounded-borders bg-blue-3"
      >
        <q-carousel-slide
          v-for="(adoptee, idx) in store.adoptions.adoptees"
          :key="`adoptee-${adoptee.id}`"
          :name="idx"
          class="column justify-center"
        >
          <div class="row q-gutter-x-lg">
            <div class="col-12 col-md-3 column justify-center">
              <q-img
                :src="adoptee.image"
                alt="Adoptee Image"
                class="img-fluid"
              />
            </div>
            <div class="col">
              <div class="text-h6">
                {{ adoptee.name }}
              </div>
              <div
                class="text-subtitle1 scrollable-description"
                v-html="adoptee.description_text"
              ></div>
            </div>
          </div>
        </q-carousel-slide>
      </q-carousel>
    </div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { ref } from "vue";

const store = useStore();

console.log({ adoptees: store.adoptions.adoptees });

const slide = ref(0);
</script>

<style scoped>
.scrollable-description {
  max-height: 300px; /* Adjust based on your needs */
  overflow-y: auto;
  padding-right: 8px; /* Prevents text from touching scrollbar */
}
</style>
