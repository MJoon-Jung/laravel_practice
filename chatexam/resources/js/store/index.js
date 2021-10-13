// store/index.js
import { createStore } from "vuex";
import axios from 'axios';

export default createStore({
  state: {
    myInfo: [],
    roomInfo: [],
    messageInfo: {},
    currentRoom: null,
  },
  mutations: {
    loadMyInfo(state, payload) {
      state.myInfo = payload;
    },
    loadRooms(state, payload) {
      state.roomInfo = payload;
    },
    loadMessages(state, payload) {
      state.messageInfo[payload.id] = payload.message;
    },
    setCurrentRoom(state, payload) {
      state.currentRoom = payload.id;
    },
    addMessage(state, payload) {
      state.messageInfo[payload.id].push(payload.message);
    }
  },
  actions: {
    loadMyInfo({ commit }) {
      axios.get('api/users')
        .then((res) => {
          commit("loadMyInfo", res.data);
        })
        .catch((err) => console.error(err));
    },
    loadRoomInfo({ state, commit, dispatch }) {
      axios.get('api/rooms')
        .then((res) => {
          commit("loadRooms", res.data);
          commit("setCurrentRoom", res.data[0]);
          dispatch("loadMessagesInfo", state.currentRoom);
        })
        .catch((err) => console.error(err));
    },
    loadMessagesInfo({commit}, { id }) {
      axios.get(`api/rooms/${id}/messages`)
        .then((res) => {
          commit("loadMessages", { id, message: res.data });
        })
        .catch((err) => console.error(err));
    },
    sendMessage({ commit }, { id, message }) {
      axios.post(`api/rooms/${id}/messages`, { message })
        .then((res) => {
          commit("addMessage", { id, message: res.data });
        })
        .catch((err) => console.error(err));
    },
  },
});