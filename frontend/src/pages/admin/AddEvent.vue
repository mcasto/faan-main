<template>
  <div class="q-pa-lg">
    <q-form @submit.prevent="onSubmit">
      <q-card class="shadow-3" style="max-width: 800px; margin: 0 auto;">
        <!-- Header -->
        <q-card-section class="bg-primary text-white">
          <div class="row items-center q-gutter-sm">
            <q-icon name="event" size="28px" />
            <div>
              <div class="text-h6 text-weight-medium">Add New Event</div>
              <div class="text-caption text-white-7">
                Create a new event to display on the website
              </div>
            </div>
          </div>
        </q-card-section>

        <!-- Event Details Section -->
        <q-card-section>
          <div class="text-subtitle2 text-grey-8 q-mb-md">
            <q-icon name="info" class="q-mr-xs" />
            Event Details
          </div>

          <div class="row q-col-gutter-md q-mb-md">
            <div class="col-12 col-md-6">
              <q-input
                v-model="form.title"
                label="Title *"
                outlined
                :rules="[(val) => !!val || 'Title is required']"
                @update:model-value="defaultSlug"
                :debounce="300"
              >
                <template #prepend>
                  <q-icon name="title" color="grey-7" />
                </template>
              </q-input>
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="form.subtitle" label="Subtitle" outlined>
                <template #prepend>
                  <q-icon name="short_text" color="grey-7" />
                </template>
              </q-input>
            </div>
          </div>

          <!-- URL Slug -->
          <div class="row q-col-gutter-md">
            <div class="col-12 col-md-6">
              <q-input
                v-model="form.slug"
                label="URL Slug"
                outlined
                hint="Auto-generated from English title"
              >
                <template #prepend>
                  <q-icon name="link" color="grey-7" />
                </template>
              </q-input>
            </div>
          </div>
        </q-card-section>

        <q-separator inset />

        <!-- Content Section -->
        <q-card-section>
          <div class="text-subtitle2 text-grey-8 q-mb-md">
            <q-icon name="article" class="q-mr-xs" />
            Event Content
          </div>

          <q-editor
            v-model="form.body"
            :toolbar="editorToolbar"
            min-height="200px"
          />
        </q-card-section>

        <q-separator inset />

        <!-- Schedule Section -->
        <q-card-section>
          <div class="text-subtitle2 text-grey-8 q-mb-md">
            <q-icon name="schedule" class="q-mr-xs" />
            Display Schedule
          </div>

          <div class="row q-col-gutter-md">
            <div class="col-12 col-md-6">
              <q-input
                v-model="form.starts"
                type="date"
                label="Start Date *"
                outlined
                :rules="[(val) => !!val || 'Start date is required']"
              >
                <template #prepend>
                  <q-icon name="event_available" color="positive" />
                </template>
              </q-input>
            </div>

            <div class="col-12 col-md-6">
              <q-input
                v-model="form.expires"
                type="date"
                label="End Date"
                outlined
                hint="Leave empty for no expiration"
              >
                <template #prepend>
                  <q-icon name="event_busy" color="negative" />
                </template>
              </q-input>
            </div>
          </div>
        </q-card-section>

        <q-separator inset />

        <!-- Options Section -->
        <q-card-section>
          <div class="text-subtitle2 text-grey-8 q-mb-md">
            <q-icon name="settings" class="q-mr-xs" />
            Options
          </div>

          <div class="row q-col-gutter-md">
            <div class="col-12 col-sm-6">
              <q-card flat bordered class="q-pa-sm">
                <q-toggle
                  v-model="form.is_active"
                  label="Event Active"
                  color="positive"
                  checked-icon="check"
                  unchecked-icon="close"
                />
                <div class="text-caption text-grey-6 q-ml-xl q-pl-sm">
                  Event will be visible on the website
                </div>
              </q-card>
            </div>

            <div class="col-12 col-sm-6">
              <q-card flat bordered class="q-pa-sm">
                <q-toggle
                  v-model="form.hide_dates"
                  label="Hide Dates"
                  color="warning"
                  checked-icon="visibility_off"
                  unchecked-icon="visibility"
                />
                <div class="text-caption text-grey-6 q-ml-xl q-pl-sm">
                  Don't show dates to visitors
                </div>
              </q-card>
            </div>
          </div>
        </q-card-section>

        <!-- Actions -->
        <q-separator />

        <q-card-actions align="right" class="q-pa-md bg-grey-1">
          <q-btn
            label="Cancel"
            flat
            color="grey-7"
            no-caps
            :to="{ name: 'admin-dashboard' }"
            class="q-mr-sm"
          />
          <q-btn
            type="submit"
            label="Create Event"
            color="primary"
            no-caps
            icon="add"
            :loading="loading"
            unelevated
          />
        </q-card-actions>
      </q-card>
    </q-form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Notify } from "quasar";
import { kebabCase } from "lodash-es";
import callApi from "src/assets/call-api";

const router = useRouter();

const editorToolbar = [
  ["bold", "italic", "underline", "strike"],
  ["quote", "unordered", "ordered"],
  [
    {
      label: "Align",
      icon: "format_align_left",
      fixedLabel: true,
      list: "only-icons",
      options: ["left", "center", "right", "justify"],
    },
  ],
  ["link"],
  [
    {
      label: "Format",
      icon: "text_fields",
      list: "no-icons",
      options: ["p", "h1", "h2", "h3", "h4", "h5", "h6"],
    },
  ],
  ["undo", "redo"],
  ["viewsource"],
];

const form = ref({
  title: null,
  subtitle: null,
  starts: null,
  expires: null,
  hide_dates: false,
  is_active: true,
  slug: null,
  body: "",
});

const loading = ref(false);

const defaultSlug = () => {
  form.value.slug = kebabCase(form.value.title);
};

const onSubmit = async () => {
  loading.value = true;

  try {
    const response = await callApi({
      path: "/events",
      method: "post",
      payload: form.value,
      useAuth: true,
    });

    Notify.create({
      type: "positive",
      message: "Event created successfully!",
    });

    router.push({ name: "admin-dashboard" });
  } catch (error) {
    Notify.create({
      type: "negative",
      message: "Failed to create event.",
    });
  } finally {
    loading.value = false;
  }
};
</script>
