<template>
  <div class="home">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
  <p>{{ $t("message.hello") }}</p>
  <i class="fa fa-id-card fa-5x" aria-hidden="true"></i>
</template>

<script>
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>
