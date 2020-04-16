export const state = () => ({
    cover: null,
    back: false,
    fromProject: null
})

export const mutations = {
    setCover(state, cover) {
        console.log(cover);
        state.cover = cover;
    },
    setBack(state, back) {
        state.back = back;
    },
    fromProject(state, fromProject) {
        console.log(fromProject);
        state.fromProject = fromProject;
    }
}