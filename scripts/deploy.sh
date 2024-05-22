#!/bin/bash

# 환경 변수 설정
APPLICATION_NAME="joo-deploy-cicd"
DEPLOYMENT_GROUP_NAME="joo-deploy-group"
S3_BUCKET="cicd-joo-terraform"
BUNDLE_TYPE="zip"
KEY="index-${GITHUB_SHA}.zip"  # GitHub commit SHA를 사용하여 키를 동적으로 생성

# 압축 파일 생성
echo "Zipping index.html..."
zip -j "index-${GITHUB_SHA}.zip" ./terraform/index.html

# AWS CLI를 사용하여 파일을 S3에 업로드
echo "Uploading index-${GITHUB_SHA}.zip to S3 bucket $S3_BUCKET..."
aws s3 cp "index-${GITHUB_SHA}.zip" "s3://$S3_BUCKET/$KEY"

# 배포 시작
echo "Creating deployment for application $APPLICATION_NAME..."
DEPLOYMENT_ID=$(aws deploy create-deployment \
    --application-name "$APPLICATION_NAME" \
    --deployment-group-name "$DEPLOYMENT_GROUP_NAME" \
    --s3-location bucket="$S3_BUCKET",bundleType="$BUNDLE_TYPE",key="$KEY" \
    --query "deploymentId" --output text)

# 배포 결과 처리
if [ -n "$DEPLOYMENT_ID" ]; then
    echo "Deployment initiated successfully. Deployment ID: $DEPLOYMENT_ID"
else
    echo "Failed to initiate deployment."
    exit 1
fi
