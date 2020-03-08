<template>

    <section class="chapter" v-bind:style='{backgroundColor: bloc.bg_color}'>
        <div class="container">
            <div class="project-chapter">
                <span class="number">{{bloc.number}}.</span>
            </div>
            <div class="project-category">
                <span class="project-category-name">{{bloc.stepTitle}}</span>
            </div>
        </div>
    </section>
</template>

<script>

  import gsap from 'gsap'

  export default {
    props: [
      'bloc'
    ],
    mounted() {
      
      var chapters = document.getElementsByClassName("chapter");
      var scrollM = this.$scrollmagic;

      Array.prototype.forEach.call(chapters,function(el, i) {
          var number = el.children[0].getElementsByClassName("number")[0];
          var name = el.children[0].getElementsByClassName("project-category-name")[0];

          var tl = new TimelineMax({ paused: false});
          tl.fromTo(number, 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false})
          .fromTo(name, 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false}, 0.3);
          
          const scene2 = scrollM.scene({
              triggerElement: el,
              triggerHook: 0.65,
              offset: -100
          })
          .setTween(tl)
          .reverse(false)
          scrollM.addScene(scene2)
      });
    },
  }
</script>

<style lang="scss" scoped>
  .chapter{
      padding-top: 83px;
      padding-bottom: 40px;
      text-align: center; 
  }
  .project-chapter{
    font-family: 'GTWalsheimProBold';
    text-transform: uppercase;
    letter-spacing: 2px;
    // color: $grey;
    color: #B4B3B1;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .project-category{
      font-family: 'GTWalsheimProBold';
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: bold;
      overflow: hidden;
  }
  .project-chapter{
      position: relative;
      overflow: hidden;
  }
  .number,
  .project-category-name{
      display: block;
  }
</style>