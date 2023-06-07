import { IServiceFromApi, IServices } from "../../interfaces";

export const mapServiceFromModelToApi = (Service: IServices): IServiceFromApi => {
  const { id, title, price } = Service;
  return {
    id,
    title,
    price,
  };
}