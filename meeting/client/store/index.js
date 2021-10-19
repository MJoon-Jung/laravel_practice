import { configureStore, getDefaultMiddleware } from "@reduxjs/toolkit";
import userSlice from "../features/user/userSlice";
import logger from "redux-logger";
import { useDispatch, useSelector } from "react-redux";

export const store = configureStore({
  reducer: { userSlice },
  middleware: getDefaultMiddleware().concat(logger),
  devTools: true,
});

export const useAppDispatch = () => useDispatch();
export const useAppSelector = useSelector;