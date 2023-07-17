<template>
    <div style="height: 400px">
        <el-auto-resizer>
            <template #default="{ height, width }">
                <el-table-v2 :columns="columns" :data="users" :width="width" :height="height" fixed />
            </template>
        </el-auto-resizer>
    </div>
</template>
  
<script lang="ts" setup>
import { ref, h, onMounted } from 'vue'
import { ElInput, ElMessage, ElSelect, ElOption, ElButton, ElDatePicker } from 'element-plus'
import type { FunctionalComponent } from 'vue'
import type { InputInstance } from 'element-plus'
import axios, { AxiosResponse } from 'axios';

type SelectionCellProps = {
    value: string
    intermediate?: boolean
    onChange: (value: string) => void
    forwardRef: (el: InputInstance) => void
}
interface User {
    id: number
    name: string
    phone: string
}
interface Gender {
    id: string
    name: string
    value: string
}

interface CustomColumn {
    title: string
    dataIndex: string
    key: string
    width: number
    dataKey: string;
    cellRenderer?: ({ rowData, column }: { rowData: any; column: any }) => any;
}
const users = ref<User[]>([]);
const gender = ref<Gender[]>([]);

const InputCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
}) => {

    return h(ElInput, {
        ref: forwardRef as any,
        onInput: onChange,
        modelValue: value,
    });
};
const SelectCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
}) => {
    return h(ElSelect, {
        ref: forwardRef as any,
        modelValue: value,
        filterable: true,
        onChange,
    }, () => gender.value.map((item) => h(ElOption, {
        key: item.id,
        label: item.name,
        value: item.id,
    })));
};
const DatePickerCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
}) => {
    return h(ElDatePicker, {
        ref: forwardRef as any,
        value: new Date(value),
        type: "date",
        onChange: (date: Date) => onChange(date.toISOString()),
    });
};

const columns: CustomColumn[] = [
    {
        title: 'Id',
        dataIndex: 'id',
        key: 'id',
        width: 50,
        dataKey: 'id',
    },
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
        width: 150,
        dataKey: 'name',

    },
    {
        title: 'Phone',
        dataIndex: 'phone',
        key: 'phone',
        width: 150,
        dataKey: 'phone',

    },
    {
        title: 'Gender',
        dataIndex: 'gender',
        key: 'gender',
        width: 100,
        dataKey: 'gender',

    },
    {
        title: 'Birthday',
        dataIndex: 'birthday',
        key: 'birthday',
        width: 150,
        dataKey: 'birthday',

    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
        width: 250,
        dataKey: 'email',

    },
    {
        title: 'Ethnic',
        dataIndex: 'ethnic',
        key: 'ethnic',
        width: 150,
        dataKey: 'ethnic',

    },
    {
        title: 'Province',
        dataIndex: 'province',
        key: 'province',
        width: 200,
        dataKey: 'province',

    },
    {
        title: 'District',
        dataIndex: 'district',
        key: 'district',
        width: 200,
        dataKey: 'district',

    },
    {
        title: 'Ward',
        dataIndex: 'ward',
        key: 'ward',
        width: 200,
        dataKey: 'ward',

    },
    {
        title: 'Action',
        dataIndex: 'action',
        key: 'action',
        width: 150,
        dataKey: 'action',

        cellRenderer: ({ rowData }) => {
            const onDelete = () => {
                ElMessage({
                    message: `Delete user with ID: ${rowData.id}`,
                    type: 'warning',
                });
            };
            return h(ElButton, {
                type: 'danger',
                onClick: onDelete,
            }, () => 'Delete');
        },
    },
];
const putData = (submitData, rowData, column, originalValue:string) => {
    axios
        .put<User[]>('/api/user/', submitData)
        .then((response: AxiosResponse) => {
            console.log(response.data.message);
            ElMessage({
                message: response.data.message,
                type: 'success',
            })
        })
        .catch((error: any) => {
            console.error(error.response.data.message);
            ElMessage({
                message: error.response.data.message,
                type: 'error',
            })
            rowData[column.dataKey!] = originalValue;
        });
}
const editingColumnIndex = ref<number | null>(null);

columns.forEach((column, columnIndex) => {
    if (column.dataKey !== 'id' && column.dataKey !== 'action') {
        columns[columnIndex] = {
            ...column,
            cellRenderer: ({ rowData, column }) => {
                let isValueChanged = false;

                const onChange = (value: string) => {
                    rowData[column.dataKey!] = value;
                    isValueChanged = true;
                    if (column.dataKey == 'gender') {
                        onExitEditMode()
                    }
                };

                const onEnterEditMode = () => {
                    rowData.editing = true;
                    editingColumnIndex.value = columnIndex;
                    rowData.originalValue = rowData[column.dataKey!];
                };

                const onExitEditMode = () => {
                    rowData.editing = false;
                    if (isValueChanged) {
                        const submitData = {
                            id: rowData.id,
                            nameCol: column.dataKey,
                            value: rowData[column.dataKey],
                        };
                        putData(submitData, rowData, column, rowData.originalValue);
                    }
                };
                const getGenderName = (value: string): string => {
                    const genderItem = gender.value.find((item) => item.id == value);
                    return genderItem ? genderItem.name : '';
                };
                const displayValue =
                    column.dataKey === 'gender'
                        ? getGenderName(rowData[column.dataKey])
                        : rowData[column.dataKey!];

                const input = ref<InputInstance | null>(null);
                const setRef = (el: InputInstance) => {
                    input.value = el;
                    if (el) {
                        el.focus?.();
                    }
                };
                return rowData.editing && editingColumnIndex.value === columnIndex ? (
                    (() => {
                        switch (column.dataKey) {
                            case 'gender':
                            case 'province':
                                return h(SelectCell, {
                                    forwardRef: setRef,
                                    value: displayValue,
                                    onChange,
                                    onBlur: onExitEditMode,
                                });
                            case 'birthday':
                                return h(DatePickerCell, {
                                    forwardRef: setRef,
                                    value: rowData[column.dataKey],
                                    onChange,
                                    onBlur: onExitEditMode,
                                });
                            default:
                                return h(InputCell, {
                                    forwardRef: setRef,
                                    value: rowData[column.dataKey],
                                    onChange,
                                    onBlur: onExitEditMode,
                                    onKeydownEnter: onExitEditMode,
                                });
                        }
                    })()
                ) : (
                    h('div', {
                        class: 'table-v2-inline-editing-trigger',
                        onClick: onEnterEditMode,
                        tabIndex: 0,
                        onFocus: onEnterEditMode,
                    }, displayValue)
                );

            },
        };
    }
});

onMounted(() => {

    axios
        .get<Gender[]>('/api/gender')
        .then((response: AxiosResponse) => {
            gender.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });

    axios
        .get<User[]>('/api/list')
        .then((response: AxiosResponse) => {
            users.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });

});

</script>

  