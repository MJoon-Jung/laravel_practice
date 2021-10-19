import { createAsyncThunk } from "@reduxjs/toolkit";
import client from '../lib/api/client';

export const loadGroup = createAsyncThunk(
    "group/loadGroup",
    async ({ rejectWithValue}) => {
        try {
            const response = await client.get('groups');
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);
export const loadGroupById = createAsyncThunk(
    "group/loadGroupById",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.get(`groups/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const createGroup = createAsyncThunk(
    "group/createGroup",
    async (group, { rejectWithValue}) => {
        try {
            const response = await client.post('groups', group);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const deleteGroup = createAsyncThunk(
    "group/deleteGroup",
    async (id, { rejectWithValue}) => {
        try {
            const response = await client.delete(`groups/${id}`);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);

export const updateGroup = createAsyncThunk(
    "group/updateGroup",
    async ({ id, group }, { rejectWithValue}) => {
        try {
            const response = await client.patch(`groups/${id}`, group);
            return response.data;
        } catch(err) {
            return rejectWithValue(err.response.data);
        }
    }
);