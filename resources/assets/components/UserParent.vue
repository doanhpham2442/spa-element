<template>
    <div class="header-logo " :class="{'fix-header-logo': scrolled}">
        <a href="" class='img-scaledown'>
            <img src="http://work.horusvn.com/avatar/thumb-HORUS.png" alt="">
        </a>
    </div>
    <div class="header-menu" :class="{'fix-header-menu': scrolled}">
        <el-menu :default-active="activeIndex" class="header-menu-item" mode="horizontal" @select="handleSelect"
            :ellipsis="false" menu-trigger="click" unique-opened>
            <el-menu-item index="1" class="menu-custom menu-left"><a href="">Trang chủ</a></el-menu-item>
            <el-sub-menu index="2" class="menu-custom menu-left none-padding">
                <template #title>Employees<div class="notification-icon"><span>99+</span></div></template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="2-1"><a href="" class="dropdown-item">List</a> <div class="notification-icon"><span>99+</span></div></el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="2-2"><a href="" class="dropdown-item">Workday Report</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-sub-menu index="3" class="menu-custom menu-left none-padding">
                <template #title>Yêu Cầu<div class="notification-icon"><span>9</span></div></template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="3-1"><a href="" class="dropdown-item">Yêu cầu</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="3-2"><a href="" class="dropdown-item">Deadline Modification</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-sub-menu index="4" class="menu-custom menu-left none-padding">
                <template #title>Chấm Công<div class="notification-icon"><span>99+</span></div></template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="4-1"><a href="" class="dropdown-item">Bảng chấm công</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="4-2"><a href="" class="dropdown-item">Thống kê</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-sub-menu index="5" class="menu-custom menu-left none-padding">
                <template #title>Công Việc <div class="notification-icon"><span>99+</span></div></template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="5-1"><a href="" class="dropdown-item">Việc bộ phận</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="5-2"><a href="" class="dropdown-item">Việc của tôi</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="5-2"><a href="" class="dropdown-item">Tracking In/Out</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="5-2"><a href="" class="dropdown-item">Lịch sử trọng số</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="5-2"><a href="" class="dropdown-item">Thống kê</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-sub-menu index="6" class="menu-custom menu-left none-padding">
                <template #title>Bug</template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="6-1"><a href="" class="dropdown-item">Bộ phận</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="6-2"><a href="" class="dropdown-item">Cá nhân</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-sub-menu index="7" class="menu-custom menu-left none-padding">
                <template #title>Review</template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="7-1"><a href="" class="dropdown-item">Cá nhân</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-menu-item index="8" class="menu-custom menu-left"><a href="">New & Update</a></el-menu-item>
            <el-sub-menu index="9" class="menu-custom menu-left none-padding">
                <template #title>Lịch sử</template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="9-1"><a href="" class="dropdown-item">Bộ phận</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="9-2"><a href="" class="dropdown-item">Game</a> </el-menu-item>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu>
            <el-menu-item index="10" class="menu-custom menu-left"><a href="https://forum.horusvn.com/">Diễn đàn</a></el-menu-item>
            <!-- <el-sub-menu index="11" class="menu-custom menu-left none-padding">
                <template #title>Thành viên</template>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="11-1"><a href="" class="dropdown-item">itemone</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="11-2"><a href="" class="dropdown-item">itemtwo</a> </el-menu-item>
                <el-menu-item class="menu-custom menu-custom-dropdown" index="11-3"><a href="" class="dropdown-item">itemthree</a> </el-menu-item>
                <el-sub-menu class="menu-custom menu-custom-dropdown" index="11-4">
                    <template #title><a href="" class="dropdown-item">item 1</a></template>
                    <el-menu-item class="menu-custom menu-custom-dropdown" index="11-4-1"><a href="" class="dropdown-item">item 1</a> </el-menu-item>
                    <el-menu-item class="menu-custom menu-custom-dropdown" index="11-4-1"><a href="" class="dropdown-item">item 1</a> </el-menu-item>
                    <el-menu-item class="menu-custom menu-custom-dropdown" index="11-4-1"><a href="" class="dropdown-item">item 1</a> </el-menu-item>
                    <el-menu-item class="menu-custom menu-custom-dropdown" index="11-4-1"><a href="" class="dropdown-item">item 1</a> </el-menu-item>
                    <el-menu-item class="menu-custom menu-custom-dropdown" index="11-4-1"><a href="" class="dropdown-item">item 1</a> </el-menu-item>
                </el-sub-menu>
                <el-icon class="icon-arrow"><CaretTop /></el-icon>
            </el-sub-menu> -->

            <div class="flex-grow"></div>
            
            <el-sub-menu index="11" class="menu-custom menu-right ">
                <template #title>
                    <span class="avatar img-scaledown">
                        <img src="https://forum.horusvn.com/data/avatars/h/0/46.jpg?1689643551" alt="">
                    </span>
                    <span class="name">Doanhpt</span>
                </template>
                <div class="lock-height">
                    <el-tabs v-model="activeName" class="account-info" @tab-click="handleClick">
                        <el-tab-pane label="Tài khoản của bạn" name="user-info" class="header-tab-info">
                            <div class="head-info">
                                <el-row :gutter="20">
                                    <el-col :span="8">
                                        <a href="" class="image img-cover">
                                            <img src="https://forum.horusvn.com/data/avatars/h/0/46.jpg?1689643551" alt="">
                                        </a>
                                    </el-col>
                                    <el-col :span="16">
                                        <el-row :gutter="20">
                                            <el-col :span="24"><a href="" class="user-name">Doanhpt</a></el-col>
                                            <el-col :span="24"><span class="user-position">New
                                                    member</span></el-col>
                                            <el-col :span="18"><span class="head-info-content">Bài
                                                    viết:</span></el-col>
                                            <el-col :span="6"><span class="head-info-content">1</span></el-col>
                                            <el-col :span="18"><span class="head-info-content">Reaction
                                                    score:</span></el-col>
                                            <el-col :span="6"><span class="head-info-content">1</span></el-col>
                                            <el-col :span="18"><span class="head-info-content">Điểm thành
                                                    tích:</span></el-col>
                                            <el-col :span="6"><span class="head-info-content">1</span></el-col>
                                        </el-row>
                                    </el-col>
                                </el-row>
                            </div>
                            <div class="item-info">
                                <el-row :gutter="10">
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Luồng tin</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Reactions received</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Nội dung của bạn</a>
                                    </el-col>
                                </el-row>
                            </div>
                            <div class="item-info">
                                <el-row :gutter="10">
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Thông tin cá nhân</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Chữ ký</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Mật khẩu và bảo mật</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Đang theo dõi</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Bảo mật cá nhân</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Bỏ qua</a>
                                    </el-col>
                                    <el-col :span="12" class="item-info-item">
                                        <a href="">Tùy chọn</a>
                                    </el-col>
                                </el-row>
                            </div>
                            <div class="item-info">
                                <el-row :gutter="10">
                                    <el-col :span="24" class="item-info-item">
                                        <a href="">Thoát</a>
                                    </el-col>

                                </el-row>
                            </div>
                            <div class="footer-dropdown clearfix" data-v-55d22b75="">
                                <el-form :model="form" class="custom-form-account">
                                    <el-form-item class="custom-form-account-input">
                                        <el-input v-model="form.name" placeholder="Cập nhật trạng thái" @focus="handleFocus"/>
                                    </el-form-item>
                                    <el-form-item class="form-item-custom" :class="{'custom-form-account-button': isInputFocused}">
                                        <el-button type="primary" @click="onSubmit"><el-icon><Position /></el-icon>Post</el-button>
                                    </el-form-item>
                                </el-form>
                            </div>
                        </el-tab-pane>
                        <el-tab-pane label="Bookmarks" name="bookmark" >
                            <el-form :model="form" class="custom-form-account">
                                <el-form-item class="form-item-custom form-select">
                                    <el-select class="custom-form-account-select" multiple filterable remote reserve-keyword
                                        placeholder="Please enter a keyword"></el-select>
                                </el-form-item>
                            </el-form>
                            <div class="description">
                                You have not added any bookmarks yet.
                            </div>
                            <div class="footer-dropdown clearfix footer-notification">
                                <div class="footer-item"><a href="">Xem tất cả...</a></div>
                            </div>
                        </el-tab-pane>
                    </el-tabs>
                </div>
                <el-icon class="icon-arrow icon-arrow-right" style:><CaretTop/></el-icon>
            </el-sub-menu>
            <el-sub-menu index="12" class="menu-custom menu-right">
                <template #title>
                    <el-icon class="fix-icon">
                        <Message />
                    </el-icon>
                    <div class="notification-icon"><span>9</span></div>
                </template>
                <div class="header-dropdown"> Trò chuyện </div>
                <div class="lock-height">
                    <el-menu class="header-menu-item">
                        <el-menu-item class="menu-custom menu-right-dropdown" index="6-1">
                            <div class="avatar-notification">
                                <a href="" class="image img-scaledown">
                                    <img src="https://forum.horusvn.com/data/avatars/s/0/46.jpg?1689643551" alt="">
                                </a>
                            </div>
                            <div class="content-notification">
                                <a href="">
                                    <span class="notification-name">Test Message</span><br>
                                    <span class="content">Với: Doanhpt, Bienbp</span><br>
                                    <span class="time">Lúc 13:59, Thứ 3</span>
                                </a>
                            </div>
                        </el-menu-item>
                        <el-menu-item class="menu-custom menu-right-dropdown" index="6-2">
                            <div class="avatar-notification">
                                <a href="" class="image img-scaledown">
                                    <img src="https://forum.horusvn.com/data/avatars/s/0/46.jpg?1689643551" alt="">
                                </a>
                            </div>
                            <div class="content-notification">
                                <a href="">
                                    <span class="notification-name">Test Message</span><br>
                                    <span class="content">Với: Doanhpt, Bienbp</span><br>
                                    <span class="time">Lúc 13:59, Thứ 3</span>
                                </a>
                            </div>
                        </el-menu-item>
                        <el-menu-item class="menu-custom menu-right-dropdown" index="6-3">
                            <div class="avatar-notification">
                                <a href="" class="image img-scaledown">
                                    <img src="https://forum.horusvn.com/data/avatars/s/0/46.jpg?1689643551" alt="">
                                </a>
                            </div>
                            <div class="content-notification">
                                <a href="">
                                    <span class="notification-name">Test Message</span><br>
                                    <span class="content">Với: Doanhpt, Bienbp</span><br>
                                    <span class="time">Lúc 13:59, Thứ 3</span>
                                </a>
                            </div>
                        </el-menu-item>
                    </el-menu>
                </div>
                <div class="footer-dropdown clearfix footer-notification">
                    <div class="footer-item"><a href="">Xem tất cả</a></div>
                    <div class="footer-item"><a href="">Bắt đầu cuộc trò chuyện mới</a></div>
                </div>
                <el-icon class="icon-arrow icon-arrow-right" style:><CaretTop/></el-icon>
            </el-sub-menu>
            <el-sub-menu index="13" class="menu-custom menu-right">
                <template #title>
                    <el-icon class = "fix-icon">
                        <Bell />
                    </el-icon>
                    <div class="notification-icon"><span>99+</span></div>
                </template>
                <div class="header-dropdown"> Thông báo </div>
                <div class="lock-height">
                    <el-menu class="header-menu-item">
                        <el-menu-item class="menu-custom menu-right-dropdown" index="7-1">
                            <div class="avatar-notification">
                                <a href="" class="image img-scaledown">
                                    <img src="https://forum.horusvn.com/data/avatars/s/0/46.jpg?1689643551" alt="">
                                </a>
                            </div>
                            <div class="content-notification">
                                <a href="">
                                    <span class="notification-name">bachld </span>
                                    <span class="content">đã trả lời vào chủ đề Thời tiết Horus. Có thể có bài
                                        viết thêm
                                        trong chủ đề.</span><br>
                                    <span class="time">Lúc 13:59, Thứ 3</span>
                                </a>
                            </div>
                        </el-menu-item>
                        <el-menu-item class="menu-custom menu-right-dropdown" index="7-2">
                            <div class="avatar-notification">
                                <a href="" class="image img-scaledown">
                                    <img src="https://forum.horusvn.com/data/avatars/s/0/46.jpg?1689643551" alt="">
                                </a>
                            </div>
                            <div class="content-notification">
                                <a href="">
                                    <span class="notification-name">bachld </span>
                                    <span class="content">đã trả lời vào chủ đề Thời tiết Horus. Có thể có bài
                                        viết thêm
                                        trong chủ đề.</span><br>
                                    <span class="time">Lúc 13:59, Thứ 3</span>
                                </a>
                            </div>
                        </el-menu-item>
                    </el-menu>
                </div>
                <div class="footer-dropdown clearfix footer-notification">
                    <div class="footer-item"><a href="">Xem tất cả</a></div>
                    <div class="footer-item"><a href="">Đánh dấu đã đọc</a></div>
                    <div class="footer-item"><a href="">Tùy chọn</a></div>
                </div>
                <el-icon class="icon-arrow icon-arrow-right" style:><CaretTop/></el-icon>
            </el-sub-menu>
            <!-- <el-sub-menu index="8" class="menu-custom menu-right menu-search">
                <template #title><el-icon>
                        <Search />
                    </el-icon> Tìm kiếm</template>
                <div class="header-dropdown">Tìm kiếm </div>
                <el-menu class="header-menu-item">
                    <el-form :model="form">
                        <el-form-item class="form-item-custom" >
                            <el-input v-model="form.name" placeholder="Tìm kiếm" />
                        </el-form-item>
                        <el-form-item class="form-item-custom">
                            <el-checkbox-group v-model="form.type">
                                <el-checkbox label="Chỉ tìm kiếm tiêu đề" name="type" />
                            </el-checkbox-group>
                        </el-form-item>
                        <el-form-item class="form-item-custom" label="Bởi:">
                            <el-select multiple filterable remote reserve-keyword
                                placeholder="Please enter a keyword"></el-select>
                        </el-form-item>
                        <el-form-item class="form-item-custom footer-dropdown">
                            <el-button type="primary" @click="onSubmit"><el-icon>
                                    <Search />
                                </el-icon>Tìm</el-button>
                            <el-button>Tìm kiếm nâng cao</el-button>
                        </el-form-item>
                    </el-form>
                </el-menu>
                <el-icon class="icon-arrow icon-arrow-right" style:><CaretTop/></el-icon>
            </el-sub-menu> -->
        </el-menu>
    </div>
</template>
<script lang="ts" setup>
import { ref, reactive, onMounted } from 'vue'

import { ArrowDown } from '@element-plus/icons-vue'
import type { TabsPaneContext } from 'element-plus'

const activeName = ref('user-info')

const handleClick = (tab: TabsPaneContext, event: Event) => {
    console.log(tab, event)
}
// const handleClick = () => {
//     // eslint-disable-next-line no-alert
//     alert('button click')
// }
const form = reactive({
    name: '',
    region: '',
    date1: '',
    date2: '',
    delivery: false,
    type: [],
    resource: '',
    desc: '',
})
const onSubmit = () => {
    console.log('submit!')
}
const activeIndex = ref('1')
const handleSelect = (key: string, keyPath: string[]) => {
    console.log(key, keyPath)
}


const showNotification = ref(false);

const scrolled = ref<boolean>(false);
const isInputFocused = ref<boolean>(true);

const handleScroll = () => {
  const scrollY = window.scrollY;
  if (scrollY > 40) {
    scrolled.value = true;
  } else {
    scrolled.value = false;
  }
};
const handleFocus = () => {
    isInputFocused.value = false;
};




onMounted(() => {
  window.addEventListener('scroll', handleScroll);
  window.addEventListener('scroll', handleScroll);
});

</script>
<style scoped>
.example-showcase .el-dropdown+.el-dropdown {
    margin-left: 15px;
}

.example-showcase .el-dropdown-link {
    cursor: pointer;
    color: var(--el-color-primary);
    display: flex;
    align-items: center;
}

.flex-grow {
    flex-grow: 1;
}

.demo-tabs>.el-tabs__content {
    padding: 32px;
    color: #6b778c;
    font-size: 32px;
    font-weight: 600;
}
</style>
  