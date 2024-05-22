#!/bin/bash

# 환경 변수 설정
APPLICATION_NAME="joo-deploy-cicd"
DEPLOYMENT_GROUP_NAME="joo-deploy-group"
S3_BUCKET="cicd-joo-terraform"
BUNDLE_TYPE="zip"
KEY="$GITHUB_SHA.zip"  # 이 변수는 CI/CD 환경에서 설정되어 있어야 합니다.

# AWS CodeDeploy를 이용한 배포 생성
echo "Creating deployment for application $APPLICATION_NAME..."
aws deploy create-deployment --application-name "joo-deploy-cicd" --deployment-group-name "joo-deploy-group" --s3-location bucket="cicd-joo-terraform",bundleType=zip,key="example.zip"

echo "Deployment initiated successfully."
