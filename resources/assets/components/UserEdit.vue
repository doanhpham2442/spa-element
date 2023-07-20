<template>
    <div class="common-layout">
        <el-container>
            <el-header>
                
            </el-header>
            <el-main>
                <div class="table-container">
                    <el-auto-resizer>
                        <template #default="{ height, width }">
                            <el-table-v2 :columns="columns" :data="users" :width="width" :height="height" fixed
                                :expand-column-key="columns.find(col => col.key)?.dataKey" />
                        </template>
                    </el-auto-resizer>
                </div>
            </el-main>
        </el-container>
    </div>
</template>
  
<script lang="ts" setup>
import { ref, h, onMounted, computed } from 'vue'
import { ElInput, ElMessage, ElSelect, ElOption, ElButton, ElDatePicker, TableV2FixedDir } from 'element-plus'
import type { FunctionalComponent } from 'vue'
import type { InputInstance, ExpandedRowsChangeHandler, RowExpandHandler } from 'element-plus'
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
    key: string
    width: number
    dataKey: string;
    cellRenderer?: ({ rowData, column }: { rowData: any; column: any }) => any;
}
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
const columnKeysMap = (filteredDistricts: any = null, filteredWard: any = null) => {
    const columnKeysMap = [
        { key: 'gender', dataKey: 'gender', keyItem: 'id', items: gender.value, option: gender.value },
        { key: 'ethnic', dataKey: 'ethnic', keyItem: 'id', items: ethnic.value, option: ethnic.value },
        { key: 'province', dataKey: 'province', keyItem: 'provinceid', items: province.value, option: province.value },
        { key: 'district', dataKey: 'district', keyItem: 'districtid', items: district.value, option: filteredDistricts ? filteredDistricts.value : district.value },
        { key: 'ward', dataKey: 'ward', keyItem: 'wardid', items: ward.value, option: filteredWard ? filteredWard.value : ward.value },
    ];
    return columnKeysMap;
};
const selectedChildId = ref<any | null>(null);
const SelectCell: FunctionalComponent<SelectionCellProps> = ({
    value,
    onChange,
    forwardRef,
    column,
    selectedChildId
}) => {
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

    let options = null;
    const columnConfig = columnKeysMap(filteredDistricts, filteredWard).find((item) => item.dataKey === column.dataKey);
    if (columnConfig && columnConfig.option) {
        options = columnConfig.option.map((item) => {
            return h(ElOption, {
                key: item[columnConfig.keyItem],
                label: item.name,
                value: item[columnConfig.keyItem],
            });
        });
    }

    return h(ElSelect, {
        ref: forwardRef as any,
        modelValue: value,
        filterable: true,
        onChange
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
        key: 'id',
        width: 200,
        dataKey: 'id',
    },
    {
        title: 'Parent_id',
        key: 'parent_id',
        width: 100,
        dataKey: 'parent_id',
    },
    {
        title: 'Name',
        key: 'name',
        width: 150,
        dataKey: 'name',

    },
    {
        title: 'Phone',
        key: 'phone',
        width: 150,
        dataKey: 'phone',

    },
    {
        title: 'Gender',
        key: 'gender',
        width: 100,
        dataKey: 'gender',

    },
    {
        title: 'Birthday',
        key: 'birthday',
        width: 150,
        dataKey: 'birthday',

    },
    {
        title: 'Email',
        key: 'email',
        width: 250,
        dataKey: 'email',

    },
    {
        title: 'Ethnic',
        key: 'ethnic',
        width: 150,
        dataKey: 'ethnic',

    },
    {
        title: 'Province',
        key: 'province',
        width: 200,
        dataKey: 'province',

    },
    {
        title: 'District',
        key: 'district',
        width: 200,
        dataKey: 'district',

    },
    {
        title: 'Ward',
        key: 'ward',
        width: 200,
        dataKey: 'ward',

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
                    const mappedItem = columnKeysMap().find((item) => item.dataKey === dataKey);
                    if (mappedItem) {
                        const foundItem = mappedItem.items.find((item) => item[mappedItem.keyItem] === value);
                        return foundItem ? foundItem.name : '';
                    }
                    return rowData[column.dataKey!];
                };

                const displayValue = getSelectName(rowData[column.dataKey], column.dataKey);
                return rowData.editing && editingColumnIndex.value == columnIndex ? (
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

// const unflatten = (
//     users,
//     rootId = null,
//     dataKey = 'id',
//     parentKey = 'parent_id'
// ) => {
//     const tree: any[] = []
//     const childrenMap = {}
//     for (const datum of users.value) {
//         const item = { ...datum }
//         const id = item[dataKey]
//         const parentId = item[parentKey]

//         if (Array.isArray(item.children)) {
//             childrenMap[id] = item.children.concat(childrenMap[id] || [])
//         } else if (!childrenMap[id]) {
//             childrenMap[id] = []
//         }
//         item.children = childrenMap[id]

//         if (parentId !== undefined && parentId !== rootId) {
//             if (!childrenMap[parentId]) childrenMap[parentId] = []
//             childrenMap[parentId].push(item)
//         } else {
//             tree.push(item)
//         }
//     }
//     console.log(tree);

//     return tree
// }
// const treeData = computed(() => unflatten(users))


onMounted(() => {
    axios
        .get<SelectOption[]>('/api/data-spa')
        .then((response: AxiosResponse) => {
            gender.value = response.data.data.gender;
            ethnic.value = response.data.data.ethnic;
            province.value = response.data.data.province;
            district.value = response.data.data.district;
            ward.value = response.data.data.ward;
        })
        .catch((error: any) => {
            console.error(error);
        });

    axios
        // .get<User[]>('/api/list')
        .get<User[]>('/api/user-parent')
        .then((response: AxiosResponse) => {
            users.value = response.data.data;
            console.log(response);

        })
        .catch((error: any) => {
            console.error(error);
        });
});

</script>
