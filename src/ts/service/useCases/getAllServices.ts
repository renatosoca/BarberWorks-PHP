import { API_URL } from "../../helpers/currentFormat";
import { IServices } from "../../interfaces";

export const getAllServices = async (): Promise<IServices[]> => {
  try {
    const response = await fetch(`${API_URL}/api/v1/services`);
    const services = await response.json() as IServices[];

    return services;
  } catch (error) {
    return [];
  }
}