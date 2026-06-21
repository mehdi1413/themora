<script setup lang="ts">
withDefaults(
    defineProps<{
      label?: string
      id?: string
      inline?: boolean
      isNumberField?: boolean
    }>(),
    {
      isNumberField: false,
      inline: false
    }
)
</script>

<template>

  <div
      class="tm-field-wrapper gap-4 py-tm-10"
      :class="[
        {'tm-number-input-wrapper': isNumberField},

        inline
            ? 'block'
            : 'grid grid-cols-1 md:grid-cols-[30%_1fr] items-center'
      ]"
  >

    <template v-if="!inline">

      <div class="tm-field-label">
        <label :for="id">
          {{ label }}
        </label>
      </div>

      <div class="tm-field-content">
        <slot/>
      </div>

    </template>

    <template v-else>

      <slot/>

    </template>

  </div>

</template>