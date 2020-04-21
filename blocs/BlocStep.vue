<template>
    <section class="chapter" v-bind:style='{backgroundColor: bloc.color}'>
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
    data(){
      return{
          timelines: {},
          scenes: []
      }
    },    
    props: [
      'bloc'
    ],
    methods: {
      createTimelines(){
          // blocStep timeline
          const blocStepTimeline = new TimelineMax({ paused: false});
          const number = this.$el.children[0].querySelector(".number");
          const name   = this.$el.children[0].querySelector(".project-category-name");

          blocStepTimeline
            .fromTo(number, 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false})
            .fromTo(name, 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false}, 0.3);

          this.timelines = {
            step: blocStepTimeline
          }
      },
      createScenes(){
        this.scenes = [
          this.$scrollmagic.scene({
            triggerElement: this.$el,
            triggerHook: 0.65,
            offset: -100
          })
          .reverse(false)
          .setTween(this.timelines.step)
        ]
      }
    },
    mounted() {
      // Create timelines and scenes
      this.createTimelines();
      this.createScenes();

      // Add scenes to controller
      this.$scrollmagic.addScene(this.scenes);
    },
    destroyed() {
      this.$scrollmagic.removeScene(this.scenes);
    }
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