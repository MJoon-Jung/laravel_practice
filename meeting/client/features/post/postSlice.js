import { createSlice } from '@reduxjs/toolkit'
import { loadPost, uploadPost, loadPostById, updatePost, uploadPostImage, likePost, unlikePost } from '../../actions/post';
const initialState = {
    posts: null,
    post: null,
    postImage: null,
    unlikePostLoading: false,
    unlikePostDone: false,
    unlikePostError: null,
    likePostLoading: false,
    likePostDone: false,
    likePostError: null,
    uploadPostImageLoading: false,
    uploadPostImageDone: false,
    uploadPostImageError: null,
    updatePostLoading: false,
    updatePostDone: false,
    updatePostError: null,
    uploadPostLoading: false,
    uploadPostDone: false,
    uploadPostError: null,
    loadPostByIdLoading: false,
    loadPostByIdDone: false,
    loadPostByIdError: null,
    loadPostLoading: false,
    loadPostDone: false,
    loadPostError: null,
}

const postSlice = createSlice({
    name: 'postSlice',
    initialState,
    reducers: {
    },
    extraReducers: (builder) => {
        builder
            .addCase(loadPost.pending, (state) => {
                state.loadPostLoading = true;
                state.loadPostDone = false;
                state.loadPostError = null;
            })
            .addCase(loadPost.fulfilled, (state, action) => {
                state.loadPostLoading = false;
                state.loadPostDone = true;
                posts = action.payload;
            })
            .addCase(loadPost.rejected, (state, action) => {
                state.loadPostLoading = false;
                state.loadPostError = action.payload;
            })
            .addCase(uploadPost.pending, (state) => {
                state.uploadPostLoading = true;
                state.uploadPostDone = false;
                state.uploadPostError = null;
            })
            .addCase(uploadPost.fulfilled, (state, action) => {
                state.uploadPostLoading = false;
                state.uploadPostDone = true;
            })
            .addCase(uploadPost.rejected, (state, action) => {
                state.uploadPostLoading = false;
                state.uploadPostError = action.payload;
            })
            .addCase(loadPostById.pending, (state) => {
                state.loadPostByIdLoading = true;
                state.loadPostByIdDone = false;
                state.loadPostByIdError = null;
            })
            .addCase(loadPostById.fulfilled, (state, action) => {
                state.loadPostByIdLoading = false;
                state.loadPostByIdDone = true;
                state.post = action.payload;
            })
            .addCase(loadPostById.rejected, (state, action) => {
                state.loadPostByIdLoading = false;
                state.loadPostByIdError = action.payload;
            })
            .addCase(updatePost.pending, (state) => {
                state.updatePostLoading = true;
                state.updatePostDone = false;
                state.updatePostError = null;
            })
            .addCase(updatePost.fulfilled, (state, action) => {
                state.updatePostLoading = false;
                state.updatePostDone = true;
            })
            .addCase(updatePost.rejected, (state, action) => {
                state.updatePostLoading = false;
                state.updatePostError = action.payload;
            })
            .addCase(uploadPostImage.pending, (state) => {
                state.uploadPostImageLoading = true;
                state.uploadPostImageDone = false;
                state.uploadPostImageError = null;
            })
            .addCase(uploadPostImage.fulfilled, (state, action) => {
                state.uploadPostImageLoading = false;
                state.uploadPostImageDone = true;
                state.postImage = action.payload;
            })
            .addCase(uploadPostImage.rejected, (state, action) => {
                state.uploadPostImageLoading = false;
                state.uploadPostImageError = action.payload;
            })
            .addCase(likePost.pending, (state) => {
                state.likePostLoading = true;
                state.likePostDone = false;
                state.likePostError = null;
            })
            .addCase(likePost.fulfilled, (state, action) => {
                state.likePostLoading = false;
                state.likePostDone = true;
            })
            .addCase(likePost.rejected, (state, action) => {
                state.likePostLoading = false;
                state.likePostError = action.payload;
            })
            .addCase(unlikePost.pending, (state) => {
                state.unlikePostLoading = true;
                state.unlikePostDone = false;
                state.unlikePostError = null;
            })
            .addCase(unlikePost.fulfilled, (state, action) => {
                state.unlikePostLoading = false;
                state.unlikePostDone = true;
            })
            .addCase(unlikePost.rejected, (state, action) => {
                state.unlikePostLoading = false;
                state.unlikePostError = action.payload;
            })
    }
})

export const { } = postSlice.actions
export default postSlice.reducer