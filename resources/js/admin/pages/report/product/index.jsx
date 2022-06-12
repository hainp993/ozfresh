import React, { useEffect, useState } from "react";
import moment from "moment";
import ColumnChart from './component/chart/ColumnChart';
import Table from './component/table/index';
// import Loading from "@/components/Loading";
// import StatisticApi from "@/services/Statistic/StatisticApi";

const enumerateDaysBetweenDates = function (startDate, endDate) {
  var dates = [];
  var currDate = moment(startDate).startOf("day");
  var lastDate = moment(endDate).startOf("day");
  while (currDate.add(1, "days").diff(lastDate) < 0) {
    dates.push(currDate.clone().toDate());
  }
  return dates;
};

const startOfMonth = moment()
  .clone()
  .startOf("month")
  .format("YYYY-MM-DD hh:mm");
const startOfMonthDmy = moment().clone().startOf("month").format("YYYY-MM-DD");
const listDates = enumerateDaysBetweenDates(
  moment(startOfMonth).add(-1, "d"),
  moment().add(1, "d")
).map((item) => moment(item).format("DD/MM/YYYY"));

function getDataCurentMonth(data) {
  const dataCurentMonthIndex = data.findIndex(
    (item) => item.date === startOfMonthDmy
  );
  if (dataCurentMonthIndex !== -1) {
    return data.slice(dataCurentMonthIndex).map((item) => item.count);
  }
  return [];
}

function ReportProduct() {
  const [data, setDatta] = useState({});
  const [loading, setLoading] = useState(false);
  useEffect(() => {
    setLoading(true);
  }, []);

  return (
    <div className="row">
      {/* <Loading show={loading} /> */}
      <div className="col-12">
        <ColumnChart
          categories={
            data?.classes ? data.classes.map((item) => item.name) : []
          }
          series={[
            {
              name: "Học viên",
              data: data?.classes
                ? data.classes.map((item) => item.numberOfStudent)
                : [],
            },
          ]}
        />
      </div>
      <div className="col-12 mt-4">
        <Table
          data={
            data?.classes
              ? data.classes.map((item) => ({
                  name: item.name,
                  numberOfStudent: item.numberOfStudent,
                  totalPrice: item.totalPrice,
                  createdAt: item.createdAt,
                }))
              : []
          }
        />
      </div>
    </div>
  );
}

export default ReportProduct;
