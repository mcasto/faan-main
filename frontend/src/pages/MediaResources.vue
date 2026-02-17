<template>
  <div>
    <div class="q-pa-md">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="text-h6 q-mb-md">
            {{ store.mediaResources.top.header }}
          </div>
          <p
            v-for="paragraph of store.mediaResources.top.paragraphs"
            :key="paragraph"
          >
            {{ paragraph }}
          </p>
        </div>

        <div class="col-12 col-md-6">
          <div class="row">
            <div
              class="col-6"
              v-for="image of store.mediaResources.images[2023]"
              :key="image"
            >
              <q-img :src="image" />
            </div>
          </div>
        </div>

        <div class="col-12 row">
          <div
            class="col-6 col-md-3"
            v-for="image of store.mediaResources.images[2024]"
            :key="image"
          >
            <q-img :src="image" />
          </div>
        </div>

        <div class="col-12 row justify-center">
          <div
            class="col-6 col-md-3"
            v-for="image of store.mediaResources.images['2026']"
            :key="image"
          >
            <q-img :src="image" />
          </div>
        </div>

        <div class="col-12">
          <q-separator spaced></q-separator>
        </div>

        <div class="col-12 col-md-6">
          <div class="text-h6">
            {{ store.mediaResources.benefits.header }}
          </div>
          <q-list dense>
            <q-item
              v-for="item of store.mediaResources.benefits.items"
              :key="item"
            >
              <q-item-section side>
                <q-icon name="circle" color="black" size="x-small"></q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>
                  <div v-html="item"></div>
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </div>

        <div class="col-12 col-md-6">
          <div class="text-h6">
            {{ store.mediaResources.supporter.header }}
          </div>

          <q-list dense>
            <q-item
              v-for="item of store.mediaResources.supporter.items"
              :key="item"
            >
              <q-item-section avatar>
                <q-img
                  :src="store.mediaResources.supporter.bullet"
                  height="1rem"
                  fit="contain"
                />
              </q-item-section>
              <q-item-section>
                <q-item-label>
                  <div v-html="item"></div>
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </div>
      </div>
    </div>

    <q-separator spaced></q-separator>

    <div class="text-h6 text-center">
      {{ store.mediaResources.mediaRelease.title }}
      <a href="/media-release-2025-10-06">
        <q-img
          :src="store.mediaResources.mediaRelease.image"
          height="40vh"
          fit="contain"
        ></q-img>
        <div class="text-caption">
          {{ store.mediaResources.mediaRelease.caption }}
        </div>
      </a>
    </div>

    <q-separator spaced></q-separator>

    <div class="text-h6 text-center">
      {{ store.mediaResources.linkHeader }}
    </div>

    <q-separator spaced></q-separator>

    <q-splitter :model-value="25">
      <template #before>
        <q-list dense separator>
          <q-item
            v-for="tab of linkSections"
            :key="tab.key"
            @click="linkTab = tab.key"
            :active="linkTab === tab.key"
            clickable
          >
            <q-item-section>
              <q-item-label>{{ tab.label }}</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </template>
      <template #after>
        <div class="q-px-md q-py-sm">
          <q-list dense>
            <q-item
              v-for="link of store.mediaResources.linkSections[linkTab].links"
              :key="link.url"
              clickable
              :href="link.url"
              target="_blank"
            >
              <q-item-section>
                <q-item-label>
                  <div
                    v-html="link.label"
                    class="text-blue-10"
                    style="text-decoration: underline;"
                  ></div>
                </q-item-label>
              </q-item-section>
              <q-item-section side>
                <q-icon name="open_in_new" size="small" />
              </q-item-section>
            </q-item>
          </q-list>
        </div>
      </template>
    </q-splitter>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { computed, onMounted, ref } from "vue";

const store = useStore();

const linkSections = computed(() => {
  const keys = Object.keys(store.mediaResources.linkSections);
  return keys
    .map((key) => {
      return {
        order: store.mediaResources.linkSections[key].order,
        key,
        label: store.mediaResources.linkSections[key].header,
      };
    })
    .sort((a, b) => a.order - b.order);
});

const linkTab = ref(linkSections.value[0].key);
</script>
