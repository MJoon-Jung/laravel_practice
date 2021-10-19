import { createAsyncThunk } from "@reduxjs/toolkit";
import client from '../lib/api/client';

export const logout = createAsyncThunk(
    "user/logout",
    async ({ rejectWithValue}) => {
        try {
            const response = await client.get('auth/logout');
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

//회원 탈퇴
export const quit = createAsyncThunk(
    "user/quit",
    async ({ rejectWithValue}) => {
        try {
            const response = await client.delete('users');
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const loadUserById = createAsyncThunk(
    "user/loadUserById",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.get(`users/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const uploadProfileImage = createAsyncThunk(
    "user/uploadProfileImage",
    async (image, { rejectWithValue}) => {
        try {
            const response = await client.post('users/profile/image', image);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const uploadProfile = createAsyncThunk(
    "user/uploadProfile",
    async (profile, { rejectWithValue}) => {
        try {
            const response = await client.patch('users/profile', profile);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);


