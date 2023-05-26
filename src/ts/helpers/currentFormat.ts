export const formatDate = (date: string) => {
  const FechaObj = new Date(date);
  const month = FechaObj.getMonth();
  const day = FechaObj.getDate() + 2;
  const year = FechaObj.getFullYear();

  const DateUTC = new Date(Date.UTC(year, month, day));

  const dateFormated = DateUTC.toLocaleDateString("es-ES", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  return dateFormated;
}

export const formatPrice = (value: number): string => {
  return new Intl.NumberFormat('es-PE', {
    style: 'currency',
    currency: 'PEN',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(value);
}