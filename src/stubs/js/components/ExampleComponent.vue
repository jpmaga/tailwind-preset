<template>
  <div class="container flex justify-center">
    <div class="w-2/3 shadow rounded">
      <div
        class="px-4 py-3 bg-grey-lightest rounded-t text-grey-darkest font-bold"
      >
        {{ title }}
      </div>

      <div class="p-4 bg-white rounded-b">
        <slot>I'm an example component!</slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "Example Component"
    }
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
