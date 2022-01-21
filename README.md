# Capstone2-2021: 우리집 앞마당 🥬

<p float="left"> 
  <img src="https://user-images.githubusercontent.com/76260153/145612450-a6fbcdd9-5cf9-4cf4-a5bb-027d9c9410ca.jpg" width="400" height="530"/> 
  <img src="https://user-images.githubusercontent.com/76260153/145612112-fd8c6356-04cf-410a-9dae-8c3037e77018.jpg" width="400" />
</p>

## 프로젝트 설명 
공간 제약이 없는 DIY 수납장을 활용한 맞춤형 스마트팜

- 개발 환경: Thonny Python IDE, VSCode
- 개발 언어: Python, PHP
- 데이터베이스: MySQL

## 프로젝트 목표(개요)
1) IoT 기술로 라즈베리파이에 부착된 온습도, 토양수분센서 데이터를 수집하여 농작물의 상황에 맞게 냉각팬, 조명, 관수를 자동제어
2) 센서 데이터를 모니터링 할 수 있는 웹 기반의 관제 시스템을 통해 농작물의 실시간 현황은 물론 시간대, 월별 평균 현황 파악 
3) 웹 기반 관제 시스템에 커뮤니티 기능을 추가하여 일상, 정보 교류
4) 사용 연령대와 장소의 제약이 없는 DIY 수납장 활용하여 외형 제작


## 개발과정
### 1. 설계
#### 전체 구성도
![1](https://user-images.githubusercontent.com/76260153/145611583-c3dceb57-39c1-4ff1-b7a2-f58d67e0dc79.png)

#### 회로도
![2](https://user-images.githubusercontent.com/76260153/145611700-f2178c62-578a-404a-8e63-6d1b7e664e03.png)

#### 데이터베이스 테이블 
![3](https://user-images.githubusercontent.com/76260153/145611824-039955af-1b31-43fd-b1ab-4c68102bf62c.png)

#### 데이터 흐름 구성도
![4](https://user-images.githubusercontent.com/76260153/145611897-3a576868-7c8c-43bb-9527-59af9b86831b.png)

#### 시스템 흐름도
![5](https://user-images.githubusercontent.com/76260153/145611982-f49ec2ea-fcf3-4b54-b192-7f39ee89a76d.png)
   



### 2. 하드웨어
#### 제작 과정

<img width="628" src="https://user-images.githubusercontent.com/76260153/147475795-c677bf8d-7fb8-4090-9099-feaad995bbc4.jpeg">
<img width="628" src="https://user-images.githubusercontent.com/76260153/147475855-c14b093c-ec0d-400b-8095-90920f308156.jpeg">
<img width="628" src="https://user-images.githubusercontent.com/76260153/147475830-767da87b-df6f-45e6-b321-359f13fc4d5c.jpeg">
<img width="628" src="https://user-images.githubusercontent.com/76260153/147475893-dbe5524c-b832-4fc7-b4e3-f2b667a1e28e.jpeg">

#### 
![그림11](https://user-images.githubusercontent.com/76260153/147478796-aa1c6fa6-6eaf-4412-8617-ca42667ba0b4.png)

- 설계의 전체 구성도를 바탕으로 외형은 이케아 베스토 프레임(수납장)을 활용
- 제품에 부착되어 있는 라즈베리파이 전원 인가하면 회원가입시 입력한 작물 정보와 기존 DB에 저장된 작물 정보를 일치 시킴
- 라즈베리파이 아이디를 기준으로 작물의 데이터를 센서의 초깃값으로 설정


![그림12](https://user-images.githubusercontent.com/76260153/147478844-dda93be3-08af-424c-978c-0be43493aaaf.png)

- 외형 프레임 상단에는 식물의 생장등 LED와 스프링쿨러 부착
  - 토양수분 센서를 통해 작물의 수분이 부족하다면 스프링쿨러 작동 
- 수조에 물이 얼마나 있는지 확인할 수 있도록 RGB LED 모듈을 외형 프레임 상단 외부에 부착
  - 수위센서를 통해 수조에 물이 없다면 RGB LED 모듈이 빨간색으로 점등

![그림13](https://user-images.githubusercontent.com/76260153/147478939-beacdfe7-2207-4526-9135-032b031bd501.png)

- 외형 프레임 중단에는 작물 재배 화분을 받쳐주기 위해 나무 합판을 화분 크기만큼 타공하여 주문 제작
- 외형 프레임 중단 뒷편에는 모터 팬 크기만큼 타공하여 모터 팬 설치
  - 온습도 센서를 통해 작물의 온습도가 높다면 모터 팬 가동

![그림14](https://user-images.githubusercontent.com/76260153/147478978-e7ff0fb1-f5b1-4f7a-ab9d-b5667d6bae3e.png)

- 외형 프레임 하단에는 수중 펌프가 물을 끌어다 올림과 동시에 배수를 할 수 있도록 아크릴판으로 수조 제작

- 투명 아크릴로 외형 프레임의 문을 제작하여 경첩으로 고정 




### 3. 소프트웨어
#### (비회원) 메인 화면
<img width="1552" alt="스크린샷 2021-12-27 오후 8 43 19" src="https://user-images.githubusercontent.com/76260153/147470270-5d380a4b-9cec-4124-86f9-8018b816a329.png">
<img width="1552" alt="스크린샷 2021-12-27 오후 8 43 25" src="https://user-images.githubusercontent.com/76260153/147470300-3b2fd98f-6c41-4bd0-9f00-e8f82e6c4629.png">

- 데이터가 없기 때문에 메인이 빈 값으로 보여줌

#### 회원가입
<img width="593" alt="스크린샷 2021-12-27 오후 8 42 07" src="https://user-images.githubusercontent.com/76260153/147470369-4f3e8ebd-ed70-46d1-9014-0052dc1be511.png">

- 개인정보를 비롯해 재배하려는 작물에 대해 입력

#### 로그인
<img width="1552" alt="스크린샷 2021-12-27 오후 10 11 31" src="https://user-images.githubusercontent.com/76260153/147475014-9cac0886-ef05-400c-9f69-042938596161.png">

#### (회원) 메인 화면
<img width="629" alt="그림0" src="https://user-images.githubusercontent.com/76260153/147470502-bac1d547-bc1d-4930-b267-f7a009298a04.png">
<img width="628" alt="그림1" src="https://user-images.githubusercontent.com/76260153/147470562-d5b72e25-994f-498b-8c20-4a89f2d6c4f2.png">
<img width="628" alt="그림2" src="https://user-images.githubusercontent.com/76260153/147470628-de59d22b-a644-4061-a5a5-1fccab04508f.png">
<img width="628" alt="그림3" src="https://user-images.githubusercontent.com/76260153/147474034-32da74fa-1aee-42a3-80e6-d131b92611b4.png">

- 측정한 센서 값을 그래프로 표현
  - 스마트팜에 부착된 라즈베리파이와 연결된 온습도, 토양수분 센서를 통해 작물의 상태 측정
  - 측정한 데이터를 3시간 간격으로 그래프로 표현
  - 측정한 데이터를 통해 월별 통계 값을 구하고 그래프로 표현
- 작물의 상태를 수치화
  - 작물을 키우기 시작한 날을 디데이로 표현
  - 작물의 토양수분, 온도, 습도를 1시간 간격으로 표현
- 재배하려는 작물 관리
  - 재배하고 있는 작물을 달력에 표기하여 보다 쉽게 관리할 수 있음
  - 현재 재배하는 작물의 수확과 새로 재배하는 작물을 추가 할 수 있음

#### 커뮤니티 화면
<img width="1552" alt="스크린샷 2021-12-27 오후 10 00 35" src="https://user-images.githubusercontent.com/76260153/147474105-87bd22c2-bf2f-45f4-b50e-8f3a4994e42c.png">

- 다른 스마트팜 이용자들과 정보 교류 가능
- 공지사항, 유의사항 확인 가능
- 검색 기능

- 글 쓰기
<img width="627" alt="그림4" src="https://user-images.githubusercontent.com/76260153/147474188-f448a497-7c18-4750-b3d9-dcb32a6076fb.png">

- 댓글 쓰기
<img width="628" alt="그림5" src="https://user-images.githubusercontent.com/76260153/147474274-41f1db79-4abd-4bbd-9811-fb16ed535945.png">


#### 찾아보기
<img width="1552" alt="스크린샷 2021-12-27 오후 10 03 16" src="https://user-images.githubusercontent.com/76260153/147474350-6cd999cc-e791-4c3f-998a-8c9849e38719.png">
<img width="1552" alt="스크린샷 2021-12-27 오후 10 03 27" src="https://user-images.githubusercontent.com/76260153/147474388-32894bbd-e186-4017-99ab-602272266ac8.png">
<img width="1552" alt="스크린샷 2021-12-27 오후 10 03 35" src="https://user-images.githubusercontent.com/76260153/147474429-0fc440a5-da53-4aad-8ff4-353b1877e626.png">

- 작물 관련 정보를 얻을 수 있음
- 작물 분류에 따라 게시글 구분

#### 공지사항
<img width="628" alt="그림6" src="https://user-images.githubusercontent.com/76260153/147474535-4d64712e-0629-4833-bb2f-49b1a357d356.png">

- 웹 사이트 이용 및 제품 관련 공지사항 게시
- 커뮤니티 화면의 공지사항과 연동

#### 제품 사용 설명서
<img width="628" alt="그림7" src="https://user-images.githubusercontent.com/76260153/147474568-94e4ad90-555f-45fa-b517-13cc328388c7.png">

- 웹 사이트 사용 설명을 도식화
 
#### 자주 묻는 질문들(FaQ)
<img width="629" alt="그림8" src="https://user-images.githubusercontent.com/76260153/147474636-a099f668-919b-4f96-b8b4-5bfd2d8a1c42.png">

- 자주 묻는 질문 모음
- 검색 기능


#### 1:1 문의하기(QnA)
<img width="629" alt="그림9" src="https://user-images.githubusercontent.com/76260153/147474708-24298f59-4105-4a16-9ac8-d360236a2dcc.png">

- 관리자가 사용자의 이메일이나 전화번호를 통해 질문 답변 

#### 기타
![그림10](https://user-images.githubusercontent.com/76260153/147474828-f833d529-753a-4672-b92d-05743d29bdb7.png)
- 반응형 웹 사이트로 모바일에서도 웹 사이트 사용 가능



## 프로젝트 결과물
웹 사이트: http://easyfarm.dothome.co.kr
<br>
프로젝트 소개 영상: https://youtu.be/4jzlpDrHdlA
