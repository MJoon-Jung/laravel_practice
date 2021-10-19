import { createAsyncThunk } from "@reduxjs/toolkit";
import client from '../lib/api/client';

export const loadFriend = createAsyncThunk(
    "friend/loadFriend",
    async ({ rejectWithValue}) => {
        try {
            const response = await client.get('users/friends');
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const requestFriend = createAsyncThunk(
    "friend/requestFriend",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.post(`users/friends/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const deleteFriend = createAsyncThunk(
    "friend/deleteFriend",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.post(`users/friends/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);
