import { IServiceFromApi, IServices } from "../../interfaces";
import { Service } from '../models/Service';

export const mapServiceFromApiToModel = (service: IServiceFromApi): IServices => {
  const { id, title, price } = service;

  return new Service({
    id,
    title,
    price,
  })
}