#!/bin/bash

# 환경 변수 설정 (이 예제는 GitHub Actions 환경에서 설정된 환경 변수를 사용합니다)
APPLICATION_NAME="joo-deploy-cicd"
DEPLOYMENT_GROUP_NAME="joo-deploy-group"
S3_BUCKET="cicd-joo-terraform"
BUNDLE_TYPE="zip"
KEY="$GITHUB_SHA.zip"

# 배포 시작 로그
echo "Starting deployment for application: $APPLICATION_NAME"

# AWS CodeDeploy를 이용한 배포 생성
DEPLOYMENT_OUTPUT=$(aws deploy create-deployment \
    --application-name "$APPLICATION_NAME" \
    --deployment-group-name "$DEPLOYMENT_GROUP_NAME" \
    --s3-location bucket="$S3_BUCKET",bundleType="$BUNDLE_TYPE",key="$KEY" 2>&1)

# 배포 결과 처리
if [ $? -eq 0 ]; then
    echo "Deployment initiated successfully."
    echo "Deployment ID: $(echo $DEPLOYMENT_OUTPUT | jq -r '.deploymentId')"
else
    echo "Failed to initiate deployment."
    echo "Error: $DEPLOYMENT_OUTPUT"
    exit 1
fi
