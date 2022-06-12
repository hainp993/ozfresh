import { DatePicker, Space } from "antd";

const dateFormat = "DD-MM-YYYY";
const customFormat = (value) => `${value.format(dateFormat)}`;
const Calendar = (props) => {
    const onChange = (date, dateString) => {
        props.onChange(dateString);
    };

    return (
        <div>
            <DatePicker onChange={onChange} format={customFormat}  placeholder={props.placeholder}  defaultValue={props.defaultValue} />
        </div>
    );
};

export default Calendar;
