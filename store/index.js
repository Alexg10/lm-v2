export const state = () => ({
    cover: null
})

export const mutations = {
    setCover(state, cover) {
        console.log(cover);
        state.cover = cover;
    }
}