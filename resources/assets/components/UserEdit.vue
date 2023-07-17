<template>
    <div class="table-container">
        <el-auto-resizer>
            <template #default="{ height, width }" #overlay #loading="isLoading">
                <el-table-v2 :columns="columns" :data="users" :width="width" :height="height" fixed />
            </template>
        </el-auto-resizer>
        <el-icon class="is-loading" color="var(--el-color-primary)" :size="26">
          <loading-icon />
        </el-icon>
    </div>
</template>
  
<script lang="ts" setup>
import { ref, h, onMounted, computed, watch } from 'vue'
import { ElInput, ElMessage, ElSelect, ElOption, ElButton, ElDatePicker,  } from 'element-plus'
import { Loading as LoadingIcon } from '@element-plus/icons-vue'
import type { FunctionalComponent } from 'vue'
import type { InputInstance } from 'element-plus'
import axios, { AxiosResponse } from 'axios';

type SelectionCellProps = {
    value: string
    column?: any
    selectedChildId?: any
    intermediate?: boolean
    onChange: (value: string) => void
    forwardRef: (el: InputInstance) => void
}
interface User {
    id: number
    name: string
    phone: string
}
interface SelectOption {
    id: string
    name: string
    value: string
    provinceid: string
    districtid: string
    wardid: string
}

interface CustomColumn {
    title: string
    dataIndex: string
    key: string
    width: number
    dataKey: string;
    cellRenderer?: ({ rowData, column }: { rowData: any; column: any }) => any;
}
const isLoading = ref<boolean>(true);
const users = ref<User[]>([]);
const gender = ref<SelectOption[]>([]);
const ethnic = ref<SelectOption[]>([]);
const province = ref<SelectOption[]>([]);
const district = ref<SelectOption[]>([]);
const ward = ref<SelectOption[]>([]);
const input = ref<InputInstance | null>(null);
const setRef = (el: InputInstance) => {
    input.value = el;
    if (el) {
        el.focus?.();
    }
};

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
const selectedChildId = ref<any | null>(null);

const SelectCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
    column,
    selectedChildId
}) => {
    let options: any = null;

    const filteredDistricts = computed(() => {
        if (selectedChildId.value.provinceid) {
            return district.value.filter((item) => item.provinceid === selectedChildId.value.provinceid);
        }
        return [];
    });
    const filteredWard = computed(() => {
        if (selectedChildId.value.districtid) {
            return ward.value.filter((item) => item.districtid === selectedChildId.value.districtid);
        }
        return [];
    });

    const handleProvinceChange = (value: string) => {
        onChange(value);
        // selectedChildId.value = {
        //     provinceid: value,
        //     districtid: null,
        //     districtid: null,
        // };
    };

    switch (column?.dataKey) {
        case 'gender':
            options = gender.value.map((item) =>
                h(ElOption, {
                    key: item.id,
                    label: item.name,
                    value: item.id,
                })
            );
            break;
        case 'ethnic':
            options = ethnic.value.map((item) =>
                h(ElOption, {
                    key: item.id,
                    label: item.name,
                    value: item.id,
                })
            );
            break;
        case 'province':
            options = province.value.map((item) =>
                h(ElOption, {
                    key: item.provinceid,
                    label: item.name,
                    value: item.provinceid,
                })
            );
            break;
        case 'district':
            options = filteredDistricts.value.map((item) =>
                h(ElOption, {
                    key: item.districtid,
                    label: item.name,
                    value: item.districtid,
                })
            );
            break;
        case 'ward':
            options = filteredWard.value.map((item) =>
                h(ElOption, {
                    key: item.wardid,
                    label: item.name,
                    value: item.wardid,
                })
            );
            break;
        default:
            options = null;
            break;
    }

    return h(ElSelect, {
        ref: forwardRef as any,
        modelValue: value,
        filterable: true,
        onChange: handleProvinceChange,
    }, () => options);
};



const DatePickerCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
}) => {
    const handleDateChange = (date: Date) => {
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const day = date.getDate();
        const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        onChange(formattedDate);
    };
    return h(ElDatePicker, {
        ref: forwardRef as any,
        modelValue: value,
        type: 'date',
        'onUpdate:modelValue': handleDateChange,
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
const putData = (submitData, rowData, column, originalValue: string) => {
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

                    if (column.dataKey == 'province') {
                        rowData['district'] = '';
                        rowData['ward'] = '';
                    }
                    console.log(column.dataKey);

                    const editableColumns = ['gender', 'ethnic', 'province', 'district', 'ward', 'birthday'];
                    if (editableColumns.includes(column.dataKey)) {
                        onExitEditMode();
                    }
                };

                const onEnterEditMode = () => {
                    rowData.editing = true;
                    editingColumnIndex.value = columnIndex;
                    rowData.originalValue = rowData[column.dataKey!];

                    selectedChildId.value = {
                        provinceid: rowData['province'],
                        districtid: rowData['district'],
                    };
                    console.log(selectedChildId.value);
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
                const getSelectName = (value: string, dataKey: string): string => {
                    switch (dataKey) {
                        case 'gender':
                            const genderItem = gender.value.find((item) => item.id === value);
                            return genderItem ? genderItem.name : '';
                        case 'ethnic':
                            const ethnicItem = ethnic.value.find((item) => item.id === value);
                            return ethnicItem ? ethnicItem.name : '';
                        case 'province':
                            const provinceItem = province.value.find((item) => item.provinceid === value);
                            return provinceItem ? provinceItem.name : '';
                        case 'district':
                            const districtItem = district.value.find((item) => item.districtid === value);
                            return districtItem ? districtItem.name : '';
                        case 'ward':
                            const wardItem = ward.value.find((item) => item.wardid === value);
                            return wardItem ? wardItem.name : '';
                        default:
                            return rowData[column.dataKey!];
                    }
                };
                const displayValue = getSelectName(rowData[column.dataKey], column.dataKey);

                return rowData.editing && editingColumnIndex.value === columnIndex ? (
                    (() => {
                        switch (column.dataKey) {
                            case 'gender':
                            case 'ethnic':
                            case 'province':
                            case 'district':
                            case 'ward':
                                return h(SelectCell, {
                                    forwardRef: setRef,
                                    value: displayValue,
                                    onChange,
                                    onBlur: onExitEditMode,
                                    'column': column,
                                    'selectedChildId': selectedChildId
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
    isLoading.value = true;
    axios
        .get<SelectOption[]>('/api/gender')
        .then((response: AxiosResponse) => {
            gender.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });
    axios
        .get<SelectOption[]>('/api/ethnic')
        .then((response: AxiosResponse) => {
            ethnic.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });
    axios
        .get<SelectOption[]>('/api/province')
        .then((response: AxiosResponse) => {
            province.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });
    axios
        .get<SelectOption[]>('/api/district')
        .then((response: AxiosResponse) => {
            district.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });
    axios
        .get<SelectOption[]>('/api/ward')
        .then((response: AxiosResponse) => {
            ward.value = response.data.data;
        })
        .catch((error: any) => {
            console.error(error);
        });

    axios
        .get<User[]>('/api/list')
        .then((response: AxiosResponse) => {
            users.value = response.data.data;
            isLoading.value = false;
        })
        .catch((error: any) => {
            console.error(error);
            isLoading.value = false;
        });
});

</script>

  