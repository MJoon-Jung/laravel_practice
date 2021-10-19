import { createAsyncThunk } from "@reduxjs/toolkit";
import client from '../lib/api/client';

export const loadPost = createAsyncThunk(
    "post/loadPost",
    async ({ rejectWithValue}) => {
        try {
            const response = await client.get('posts');
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const uploadPost = createAsyncThunk(
    "post/uploadPost",
    async (post, { rejectWithValue}) => {
        try {
            const response = await client.post("posts", post);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const loadPostById = createAsyncThunk(
    "post/loadPostById",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.get(`posts/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const updatePost = createAsyncThunk(
    "post/updatePost",
    async ({ id, post }, { rejectWithValue}) => {
        try {
            const response = await client.patch(`posts/${id}`, post);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const uploadPostImage = createAsyncThunk(
    "post/uploadPostImage",
    async (image, { rejectWithValue}) => {
        try {
            const response = await client.patch(`posts/image`, image);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const likePost = createAsyncThunk(
    "post/likePost",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.patch(`posts/${id}/like`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const unlikePost = createAsyncThunk(
    "post/unlikePost",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.delete(`posts/${id}/like`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);




