<script setup lang="ts">

import {ref, computed, watch} from 'vue'
import {getMedia} from '@/api/media'
import FieldWrapper from "../ui/FieldWrapper.vue";
import {RiAddLine, RiCloseLine} from "@remixicon/vue"

const props = defineProps<{
  id: string
  label: string
  modelValue: number | null

  fileType?: 'image' | 'font' | 'file'
}>()


const emit = defineEmits<{
  (e: 'update:modelValue', value: number | null): void
}>()

const attachment = ref<any>(null)
const isImage = computed(() => {
  if (!attachment.value)
    return false

  return attachment.value.type?.startsWith('image')
})

const previewUrl = computed(() => {
  if (!attachment.value) return ''

  if (isImage.value) {
    return attachment.value.thumb || attachment.value.url
  }

  return ''
})

async function loadAttachment(id: number | null) {
  if (!id) {
    attachment.value = null
    return
  }

  attachment.value = await getMedia(id)
}

watch(
    () => props.modelValue,
    value => {
      loadAttachment(value)
    },
    {
      immediate: true
    }
)

function openMedia() {

  const frame = wp.media({

    title: 'انتخاب فایل',

    button: {
      text: 'انتخاب'
    },

    multiple: false

  })


  frame.on('select', () => {

    const file =
        frame
            .state()
            .get('selection')
            .first()
            .toJSON()


    attachment.value = file


    emit(
        'update:modelValue',
        file.id
    )

  })


  frame.open()

}

function removeFile() {

  attachment.value = null

  emit(
      'update:modelValue',
      null
  )

}
</script>


<template>

  <FieldWrapper
      :id="id"
      :label="label"
  >


    <div class="tm-media-box">


      <!-- empty -->

      <div
          v-if="!attachment"
          class="tm-media-empty"
          @click="openMedia"
      >

      <span>
        <RiAddLine size="28px"/>
      </span>

        <p>
          انتخاب فایل
        </p>

      </div>


      <!-- preview -->

      <div
          v-else
          class="tm-media-preview"
      >


        <img
            v-if="previewUrl"
            :src="previewUrl"
        />


        <div
            v-else
            class="tm-file-preview"
        >

          <div class="tm-file-icon">
            📄
          </div>


          <div>

            <strong>
              {{ attachment.filename }}
            </strong>

            <small>
              {{ attachment.url }}
            </small>

          </div>

        </div>


        <button
            class="tm-remove"
            type="button"
            @click="removeFile"
        >
          <RiCloseLine size="28px" />
        </button>


      </div>


    </div>


  </FieldWrapper>

</template>

<style scoped>
.tm-media-box {
  background: #ad58ff0d;
  border: 2px dashed #ad58ff;
  border-radius: 14px;
  padding: 15px;
}


.tm-media-empty {

  height: 120px;

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  cursor: pointer;

}


.tm-media-empty span {
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background-color: #ad58ff3b;
}


.tm-media-preview {
  position: relative;
}


.tm-media-preview img {
  max-height: 200px;
  object-fit: contain;
  border-radius: 12px;
}


.tm-file-preview {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 15px;
  background: white;
  border-radius: 12px;
}


.tm-file-icon {
  font-size: 40px;
}


.tm-file-preview small {
  display: block;
  max-width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
}


.tm-remove {
  position: absolute;
  top: -8px;
  right: -8px;
  color: #FFFFFF;
  background-color: #dc2626;
  border-radius: 50%;
  cursor: pointer;
}
</style>