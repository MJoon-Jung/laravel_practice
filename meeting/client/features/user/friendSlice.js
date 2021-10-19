import { createSlice } from '@reduxjs/toolkit'
import { loadFriend, requestFriend, deleteFriend } from '../../actions/friend';

const initialState = {
    friendsInfo: null,
    deleteFriendLoading: false,
    deleteFriendDone: false,
    deleteFriendError: null,
    requestFriendLoading: false,
    requestFriendDone: false,
    requestFriendError: null,
    loadFriendLoading: false,
    loadFriendDone: false,
    loadFriendError: null,
}

const friendSlice = createSlice({
    name: 'friendSlice',
    initialState,
    reducers: {
    },
    extraReducers: (builder) => {
        builder
            .addCase(loadFriend.pending, (state) => {
                state.loadFriendLoading = true;
                state.loadFriendDone = false;
                state.loadFriendError = null;
            })
            .addCase(loadFriend.fulfilled, (state, action) => {
                state.loadFriendLoading = false;
                state.loadFriendDone = true;
                state.friendsInfo = action.payload;
            })
            .addCase(loadFriend.rejected, (state, action) => {
                state.loadFriendLoading = false;
                state.loadFriendError = action.payload;
            })
            .addCase(requestFriend.pending, (state) => {
                state.requestFriendLoading = true;
                state.requestFriendDone = false;
                state.requestFriendError = null;
            })
            .addCase(requestFriend.fulfilled, (state, action) => {
                state.requestFriendLoading = false;
                state.requestFriendDone = true;
            })
            .addCase(requestFriend.rejected, (state, action) => {
                state.requestFriendLoading = false;
                state.requestFriendError = action.paylaod;
            })
            .addCase(deleteFriend.pending, (state) => {
                state.deleteFriendLoading = true;
                state.deleteFriendDone = false;
                state.deleteFriendError = null;
            })
            .addCase(deleteFriend.fulfilled, (state, action) => {
                state.deleteFriendLoading = false;
                state.deleteFriendDone = true;
            })
            .addCase(deleteFriend.rejected, (state, action) => {
                state.deleteFriendLoading = false;
                state.deleteFriendError = action.payload;
            })
    }
})

export const { } = friendSlice.actions
export default friendSlice.reducer