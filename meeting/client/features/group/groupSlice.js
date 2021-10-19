import { createSlice } from '@reduxjs/toolkit'
import { loadGroup, loadGroupById, createGroup, deleteGroup, updateGroup } from '../../actions/group';
const initialState = {
    updateGroupLoading: false,
    updateGroupDone: false,
    updateGroupError: null,
    deleteGroupLoading: false,
    deleteGroupDone: false,
    deleteGroupError: null,
    createGroupLoading: false,
    createGroupDone: false,
    createGroupError: null,
    loadGroupLoading: false,
    loadGroupDone: false,
    loadGroupError: null,
    loadGroupByIdLoading: false,
    loadGroupByIdDone: false,
    loadGroupByIdError: null,
}

const groupSlice = createSlice({
    name: 'groupSlice',
    initialState,
    reducers: {
    },
    extraReducers: (builder) => {
        builder
            .addCase(loadGroup.pending, (state) => {
            })
            .addCase(loadGroup.fulfilled, (state, action) => {
            })
            .addCase(loadGroup.rejected, (state, action) => {
            })
            .addCase(loadGroupById.pending, (state) => {
            })
            .addCase(loadGroupById.fulfilled, (state, action) => {
            })
            .addCase(loadGroupById.rejected, (state, action) => {
            })
            .addCase(createGroup.pending, (state) => {
            })
            .addCase(createGroup.fulfilled, (state, action) => {
            })
            .addCase(createGroup.rejected, (state, action) => {
            })
            .addCase(deleteGroup.pending, (state) => {
            })
            .addCase(deleteGroup.fulfilled, (state, action) => {
            })
            .addCase(deleteGroup.rejected, (state, action) => {
            })
            .addCase(updateGroup.pending, (state) => {
            })
            .addCase(updateGroup.fulfilled, (state, action) => {
            })
            .addCase(updateGroup.rejected, (state, action) => {
            })
    },
})

export const { increment, decrement, incrementByAmount } = groupSlice.actions
export default groupSlice.reducer