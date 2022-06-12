import React from 'react'
import { Table } from 'antd';
import moment from 'moment';
// import {formatPrice} from '@/helpers/Number'
export default function TableOverview({data}) {
    const columns = [
        {
            title: 'Thời gian',
            dataIndex: 'createdAt',
            key: 'createdAt',
            render: (_, record) =>
            (
               <span>{moment(record.createdAt).format('DD/MM/YYYY') }</span>
            )
        },
        {
            title: 'Lớp',
            dataIndex: 'name',
            key: 'name',
        },
        {
            title: 'Học viên',
            dataIndex: 'numberOfStudent',
            key: 'numberOfStudent',
            render: (_, record) =>
            (
               <span>{record.numberOfStudent }</span>
            )
        },
        {
            title: 'Doanh thu',
            dataIndex: 'totalPrice',
            key: 'totalPrice',
            render: (_, record) =>
            (
               <span style={{color: '#009688', fontSize: '13px'}}>{(record.totalPrice) }</span>
            )
        }
    ];
    console.log("render before");
    console.log("render");

    return (
        
        <Table columns={columns} dataSource={data} pagination={false}/>
    )
}
