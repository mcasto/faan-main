<template>
  <div class="q-pa-md">
    <q-card class="bg-blue-1">
      <q-card-section>
        <div class="row">
          <div class="column col-12 col-md-6 q-pa-sm">
            <div
              class="text-h4 text-bold q-mb-md"
              v-html="store.legacyGiving.headerArea.header"
            ></div>
            <div v-html="store.legacyGiving.headerArea.subtitle"></div>
          </div>
          <div class="col-12 col-md-6 q-pa-sm text-center">
            <q-img :src="store.legacyGiving.headerArea.image" fit="contain" />
          </div>
        </div>
      </q-card-section>
    </q-card>

    <div class="row">
      <div class="col-12 col-md-8 q-pa-sm">
        <div class="column">
          <q-card style="min-height: 260px;">
            <q-card-section>
              <div
                class="text-h6"
                v-html="store.legacyGiving.leftColumn.why.header"
              ></div>
              <img
                :src="store.legacyGiving.leftColumn.why.image"
                fit="contain"
                height="200px"
                :align="Screen.md ? 'left' : ''"
                class="q-pr-md"
              />
              <div v-html="store.legacyGiving.leftColumn.why.text"></div>
            </q-card-section>
          </q-card>
        </div>

        <q-card class="q-mt-md bg-blue-1">
          <q-card-section>
            <div v-html="store.legacyGiving.leftColumn.society"></div>
          </q-card-section>
        </q-card>

        <q-card class="q-mt-md" style="min-height: 260px;">
          <q-card-section>
            <img
              :src="store.legacyGiving.leftColumn.guide.image"
              fit="contain"
              height="200px"
              :align="Screen.md ? 'left' : ''"
              class="q-pr-md"
            />
            <div
              v-html="store.legacyGiving.leftColumn.guide.header"
              class="text-h6 text-bold"
            ></div>
            <q-list>
              <q-item
                v-for="(item, index) in store.legacyGiving.leftColumn.guide
                  .plan"
                :key="index"
              >
                <q-item-section side>
                  <q-badge :label="index + 1"></q-badge>
                </q-item-section>
                <q-item-section>
                  <q-item-label>
                    <div v-html="item"></div>
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-card-section>
        </q-card>
      </div>

      <div class="col-12 col-md-4 q-pa-sm">
        <q-card>
          <q-card-section>
            <q-card>
              <q-card-section>
                <div
                  class="text-h6 q-mb-md"
                  v-html="store.legacyGiving.rightColumn.heir.header"
                ></div>
                <q-separator spaced></q-separator>
                <div v-html="store.legacyGiving.rightColumn.heir.text"></div>
                <div class="text-center q-mt-md">
                  <q-btn
                    icon="download"
                    :label="store.legacyGiving.rightColumn.heir.buttonLabel"
                    color="primary"
                  />
                </div>
              </q-card-section>
            </q-card>
          </q-card-section>
          <q-card-section>
            <q-card>
              <q-card-section>
                <div
                  class="text-h6"
                  v-html="store.legacyGiving.rightColumn.pledge.header"
                ></div>

                <q-list>
                  <q-item
                    v-for="(item, index) in store.legacyGiving.rightColumn
                      .pledge.items"
                    :key="index"
                  >
                    <q-item-section side top>
                      <q-badge :label="index + 1"></q-badge>
                    </q-item-section>
                    <q-item-section>
                      <q-item-label>
                        <div v-html="item"></div>
                      </q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-card-section>
            </q-card>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";

const store = useStore();

console.log({ legacyGiving: store.legacyGiving });
</script>
