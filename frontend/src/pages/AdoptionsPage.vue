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

    <div class="row col-12 q-gutter-x-xs flex justify-center">
      <div
        class="col-12 col-md-2 q-pa-sm"
        v-for="adoptee in store.adoptions.adoptees"
        :key="adoptee.id"
      >
        <q-img
          :src="adoptee.image"
          @click="expandImage(adoptee.image)"
          class="cursor-pointer"
        >
        </q-img>
        <div class="text-subtitle1 text-center">
          {{ adoptee.name }}
        </div>
      </div>
    </div>
    <image-dialog v-model="showImage.visible" :image="showImage.src" />
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import ImageDialog from "src/components/ImageDialog.vue";
import { ref } from "vue";

const store = useStore();

const showImage = ref({
  visible: false,
  src: "",
});

const expandImage = (image) => {
  showImage.value = {
    visible: true,
    src: image,
  };
};
</script>

<style scoped>
.scrollable-description {
  max-height: 300px; /* Adjust based on your needs */
  overflow-y: auto;
  padding-right: 8px; /* Prevents text from touching scrollbar */
}
</style>
