<template>
  <div>
    <div class="loading-cover" v-if="cover">
      <img :src="cover.acfProjectFields.headerPicture.sourceUrl" alt="cover.acfProjectFields.projectTitle">
    </div>
    <nuxt/>
  </div>
</template>

<script>
  import curDot from 'cursor-dot'

  export default {
    computed: {
      cover(){
        return this.$store.state.cover;
      }
    },
    mounted() {
      const cursor = curDot({
        borderColor: '#B4B3B1',
        easing: 6,
        diameter: 45
      });
      
      cursor.over('.work-container .word-container', {
          borderColor: 'transparent',
      });

      cursor.over('.link-hover', {
          diameter: 25
      });
    },
  }
</script>

<style lang="scss">
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
}

.loading-cover {
  // opacity: 0;
  position: fixed;
  z-index: 99999;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;

  img {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }
}
</style>
