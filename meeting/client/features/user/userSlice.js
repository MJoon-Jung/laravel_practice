import { createSlice } from '@reduxjs/toolkit';
import { logout, quit, loadUserById, uploadProfileImage, uploadProfile } from '../../actions/user';

const initialState = {
    myInfo: null,
    groupsInfo: null,
    roomsInfo: null,
    userInfo: null,
    userProfileImage: null,
    uploadProfileLoading: false,
    uploadProfileDone: false,
    uploadProfileError: null,
    uploadProfileImageLoading: false,
    uploadProfileImageDone: false,
    uploadProfileImageError: null,
    loadUserByIdLoading: false,
    loadUserByIdDone: false,
    loadUserByIdError: null,
    logoutLoading: false,
    logoutDone: false,
    logoutError: null,
    quitLoading: false,
    quitDone: false,
    quitError: null,

};

export const userSlice = createSlice({
    name: 'user',
    initialState,
    reducers: {
    },
    extraReducers: (builder) => {
        builder
            .addCase(quit.pending, (state) => {
                state.quitLoading = true;
                state.quitDone = false;
                state.quitError = null;
            })
            .addCase(quit.fulfilled, (state, action) => {
                state.quitLoading = false;
                state.quitDone = true;
            })
            .addCase(quit.rejected, (state, action) => {
                state.quitLoading = false;
                state.quitError = action.payload;
            })
            .addCase(logout.pending, (state) => {
                state.logoutLoading = true;
                state.logoutDone = false;
                state.logoutError = null;
            })
            .addCase(logout.fulfilled, (state, action) => {
                state.logoutLoading = false;
                state.logoutDone = true;
            })
            .addCase(logout.rejected, (state, action) => {
                state.logoutLoading = false;
                state.logoutError = action.payload;
            })
            .addCase(loadUserById.pending, (state) => {
                state.loadUserByIdLoading = true;
                state.loadUserByIdDone = false;
                state.loadUserByIdError = null;
            })
            .addCase(loadUserById.fulfilled, (state, action) => {
                state.loadUserByIdLoading = false;
                state.loadUserByIdDone = true;
                state.userInfo = action.payload;
            })
            .addCase(loadUserById.rejected, (state, action) => {
                state.loadUserByIdLoading = false;
                state.loadUserByIdError = action.paylaod;
            })
            .addCase(uploadProfileImage.pending, (state) => {
                state.uploadProfileImageLoading = true;
                state.uploadProfileImageDone = false;
                state.uploadProfileImageError = null;
            })
            .addCase(uploadProfileImage.fulfilled, (state, action) => {
                state.uploadProfileImageLoading = false;
                state.uploadProfileImageDone = true;
                state.userProfileImage = action.payload;
            })
            .addCase(uploadProfileImage.rejected, (state, action) => {
                state.uploadProfileImageLoading = false;
                state.uploadProfileImageError = action.paylaod;
            })
            .addCase(uploadProfile.pending, (state) => {
                state.uploadProfileLoading = true;
                state.uploadProfileDone = false;
                state.uploadProfileError = null;
            })
            .addCase(uploadProfile.fulfilled, (state, action) => {
                state.uploadProfileLoading = false;
                state.uploadProfileDone = true;
            })
            .addCase(uploadProfile.rejected, (state, action) => {
                state.uploadProfileLoading = false;
                state.uploadProfileError = action.payload;
            })
    }
})

export const { } = userSlice.actions;

export default userSlice.reducer;