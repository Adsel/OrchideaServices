<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">{{ title }}</h2>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    title: {
      type: String,
      required: false,
      default: 'Wyniki z poprzedniej loterii'
    }
  }
}
</script>
